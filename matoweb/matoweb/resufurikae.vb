Imports System.IO
Imports System.Text

Public Class resufurikae
    Private cstrHTML(100000) As String
    Private cintHTMLCnt As Integer = 0
    Private csqlclass As New sqlClass
    Public Sub shutoku(ByVal urlv As String, ByRef titlev As String, ByRef bodyv As Object)
        Try


            Dim client As System.Net.WebClient = New System.Net.WebClient()
            Dim url As String
            Dim lbody As New ArrayList

            bodyv = lbody

            url = urlv


            '指定したURLからデータを取得する

            Dim wkStream As System.IO.Stream = _
                        client.OpenRead(url)



            'エンコード指定で文字列を取得する

            'サイトによってエンコードは異なる

            'Dim sr As StreamReader = New StreamReader(wkStream, _
            '    System.Text.Encoding.GetEncoding("utf-8"))

            'start

            Dim line As String = ""
            Dim al As New ArrayList
            Using sr As StreamReader = New StreamReader( _
              wkStream, Encoding.GetEncoding("Shift_JIS"))

                line = sr.ReadLine()
                Do Until line Is Nothing
                    al.Add(line)
                    line = sr.ReadLine()
                Loop

            End Using
            'end


            'Dim html As String = sr.ReadToEnd()


            'sr.Close()

            ''内容を一文字ずつ読み込む
            'While sr.Peek() > -1

            '    cstrHTML(cintHTMLCnt) = (sr.ReadLine())
            '    cintHTMLCnt += 1
            'End While


            wkStream.Close()

            Debug.WriteLine(al)

            'タイトル処理
            Dim lstrtitle As String
            Dim lintkaishi As Integer = 0
            Dim lintushiro As Integer = 0
            Dim linttage As Integer = 0

            'タイトル検索
            For i As Integer = 0 To al.Count - 1
                If al(i).ToString.Length > 3 Then
                    If al(i).ToString.Substring(0, 3) = "<dl" Then
                        linttage = i
                    End If
                End If
            Next

            lstrtitle = al(linttage - 1).ToString

            'Dat落ちなら終了
            If lstrtitle.Length <= 4 Then
                Exit Sub
            End If

            For i As Integer = 0 To lstrtitle.Length - 1
                If lstrtitle(i) = ">" Then
                    lintkaishi += 1
                    If lintkaishi = 1 Then
                        lintkaishi = i
                    End If
                End If
            Next
            lintushiro = lstrtitle.Length - lintkaishi - 5

            lstrtitle = lstrtitle.Substring(lintkaishi)
            lstrtitle = lstrtitle.Substring(0, lintushiro)

            titlev = lstrtitle

            '本文処理
            Dim a As New ArrayList
            lbody = a
            For i As Integer = 0 To al.Count - 1
                If al(i).ToString.Length > 4 Then
                    If al(i).substring(0, 4) = "<dt>" Then
                        lbody.Add(al(i))
                    End If
                End If
            Next

            Dim lintkaisiColor As Integer = 0
            Dim lstrBun As String
            Dim lintMaxGyo As Integer = 120


            'レス入れ替え処理
            Dim lstrRes As String = ""
            Dim lintNo(lbody.Count) As Integer

            For i As Integer = 0 To lbody.Count - 1
                lintNo(i) = i
            Next


            For i As Integer = 1 To lbody.Count - 1
                lstrBun = lbody(i).ToString
                lintkaisiColor = 0
                'For j As Integer = 0 To lstrBun.Length - 1

                '    If lstrBun(j) = ">" Then
                '        lintkaisiColor += 1
                '        If lintkaisiColor = 6 Then
                '            lintkaisiColor = j
                '            Exit For
                '        End If
                '    End If
                'Next
                lintkaisiColor = lstrBun.IndexOf("<dd>") + 3
                'ここまで本文抽出

                'ここから入れ替え
                Dim lintKensakuIti As Integer = 0
                Dim lintNextIti As Integer = 0
                Dim lintAiteSuji As Integer = 0
                Dim lblnSaisho As Boolean = False
                Dim lblnBR As Boolean = False

                lstrRes = lstrBun.Substring(lintkaisiColor + 1, lstrBun.Length - lintkaisiColor - 1)

                If IKUTU(lstrRes) <> -1 Then
                    'レスがあればレスのかずだけ処理
                    For j As Integer = 0 To IKUTU(lstrRes) - 1
                        '相手レス番号が１なら飛ばす
                        If getAiteSuji(lstrRes, j) = 1 Then
                            'レス番号格納
                            lintNo(i) = i
                        Else


                            lbody(i) = ""
                            lblnBR = False

                            'レスが最初になければその文をそのまま
                            If lstrRes.Length > 12 Then
                                If lstrRes.Substring(0, 12) = "<font color=" Then
                                    '文字置き換えなら
                                    If lstrRes.Substring(24, 8) <> "<a href=" Then
                                        lbody(i) = lstrBun.Substring(0, StartMyIndexOf(lstrBun, 0) - 1) & "</font>"
                                        lblnSaisho = True
                                    End If
                                Else
                                    '黒文字なら
                                    If lstrRes.Substring(0, 9) <> " <a href=" Then
                                        lbody(i) = lstrBun.Substring(0, StartMyIndexOf(lstrBun, 0) - 1)
                                        lblnSaisho = True
                                    End If
                                End If
                            End If

                            'レス相手数字取り出し
                            lintAiteSuji = getAiteSuji(lstrRes, j)
                            '文なしなら排除
                            If lintAiteSuji = -1 Then
                                Exit For
                            End If

                            '次の番号
                            If j = IKUTU(lstrRes) - 1 Then
                                '最後なら最終文字
                                lintNextIti = lstrRes.Length
                            Else
                                'lintNextIti = StartMyIndexOf(lstrRes, j + 1) - StartMyIndexOf(lstrRes, j)
                                lintNextIti = StartMyIndexOf(lstrRes, j + 1)
                            End If

                            'レス追加
                            If i > lintAiteSuji - 1 Then
                                'BR処理
                                If lstrRes.Substring(0, 12) = "<font color=" Then
                                    '文字置き換えなら
                                    If j = 0 Then
                                        '最初なら
                                        If StartMyIndexOf(lstrRes, j) = 0 Then
                                            Exit Sub
                                        End If
                                        If lstrRes.Substring(StartMyIndexOf(lstrRes, j) - 1, 1) = ">" Then
                                        Else
                                            If lblnSaisho Then
                                                lbody(i) = lbody(i) & "" & lstrRes.Substring(0, 24) & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                                If j <> IKUTU(lstrRes) - 1 Then
                                                    lbody(lintNo(lintAiteSuji - 1)) &= "</font>"
                                                End If
                                            Else
                                                lbody(i) = lbody(i) & "" & lstrBun.Substring(0, StartMyIndexOf(lstrBun, 0) - 1) _
                                                                     & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                                If j <> IKUTU(lstrRes) - 1 Then
                                                    lbody(lintNo(lintAiteSuji - 1)) &= "</font>"
                                                End If
                                            End If
                                            lblnBR = True
                                        End If
                                    Else
                                        '2番以降なら
                                        If lstrRes.Substring(StartMyIndexOf(lstrRes, j) - 2, 1) = ">" Then
                                        Else

                                            lbody(lintNo(lintNo(i))) = lbody(lintNo(lintNo(i))) & "" & lstrRes.Substring(0, 24) & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                            '最終以外ならFontを閉じる
                                            If j <> IKUTU(lstrRes) - 1 Then
                                                lbody(lintNo(lintAiteSuji - 1)) &= "</font><br>"
                                            End If
                                            lblnBR = True
                                        End If
                                    End If

                                Else
                                    '黒文字なら
                                    If j = 0 Then
                                        '最初なら
                                        If lblnSaisho Then
                                            If lstrRes.Substring(StartMyIndexOf(lstrRes, j) - 1, 1) = ">" Then
                                            Else
                                                lbody(i) = lbody(i) & "" & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                                lblnBR = True
                                            End If
                                        Else
                                            If StartMyIndexOf(lstrRes, j) = 1 Then
                                            Else
                                                lbody(i) = lbody(i) & "" & lstrBun.Substring(0, StartMyIndexOf(lstrBun, 0) - 1) _
                                                                    & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                                lblnBR = True
                                            End If
                                        End If
                                    Else
                                        '2番以降なら
                                        If lstrRes.Substring(StartMyIndexOf(lstrRes, j) - 2, 1) = ">" Then
                                        Else
                                            lbody(lintNo(lintNo(i))) = lbody(lintNo(lintNo(i))) & "" & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))

                                            lblnBR = True
                                        End If
                                    End If
                                End If

                                'レス番号格納
                                If lblnBR Then
                                    lblnBR = True
                                Else
                                    If lblnSaisho Then
                                        lintNo(i) = i
                                    Else
                                        lintNo(i) = lintAiteSuji - 1
                                    End If
                                End If

                                'BR処理さっれていれば飛ばす
                                If lblnBR Then
                                Else
                                    If lstrRes.Length > 12 Then
                                        If lstrRes.Substring(0, 12) = "<font color=" Then
                                            lbody(lintNo(lintNo(i))) = lbody(lintNo(lintNo(i))) & vbCrLf _
                                                                & "<dt>" & lstrBun.Substring(0, lintkaisiColor + 1) _
                                                                & lstrRes.Substring(0, 24) & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                            '最終以外ならFontを閉じる
                                            If j <> IKUTU(lstrRes) - 1 Then
                                                lbody(lintNo(lintAiteSuji - 1)) &= "</font>"
                                            End If
                                        Else
                                            lbody(lintNo(lintNo(i))) = lbody(lintNo(lintNo(i))) & vbCrLf _
                                                                & "<dt>" & lstrBun.Substring(0, lintkaisiColor + 1) _
                                                                & lstrRes.Substring(StartMyIndexOf(lstrRes, j), lintNextIti - StartMyIndexOf(lstrRes, j))
                                        End If
                                    End If
                                End If


                                'BRと最初の分がなければ消す
                                If (lblnBR = False) And (lblnSaisho = False) Then
                                    lbody(i) = ""
                                End If

                            End If
                        End If
                    Next
                Else
                    'レスがなければそのまま

                    'レス番号格納
                    lintNo(i) = i
                End If
                lblnSaisho = False
            Next

            '禁止ワード処理(速アウト）
            Dim dts As DataSet

            csqlclass.selectData("select word  from ms_kinshi where shurui = 1 ", dts)
            For j As Integer = 0 To dts.Tables(0).Rows.Count - 1
                If lstrtitle.IndexOf(dts.Tables(0).Rows(j).Item("word")) <> -1 Then

                    Exit Sub
                End If
                For i As Integer = 0 To lbody.Count - 1
                    If lbody(i).ToString <> "" Then
                        If lbody(i).ToString.IndexOf(dts.Tables(0).Rows(j).Item("word").ToString) <> -1 Then
                            Exit Sub
                        End If
                    End If
                Next

            Next


            'レス入れ替え空行削除 最大行削除
            Dim lintMax As Integer = 0
            For i As Integer = 0 To lbody.Count - 1
                If lbody(i).ToString <> "" Then
                    If lintMax = lintMaxGyo Then
                        Exit For
                    End If
                    bodyv.add(lbody(i).ToString)
                    lintMax += 1
                End If
            Next

            '分割処理
            Dim lintMojiSuu As Integer = 0
            For i As Integer = 0 To bodyv.count - 1
                lintMojiSuu += bodyv(i).ToString.Length
                If lintMojiSuu >= 350 Then
                    '引用元挿入
                    bodyv(i) = bodyv(i) & "<br>引用元：<a href=""" & urlv & """>" & lstrtitle & "</a>" & "BUNKATSU"
                    Exit For
                End If
            Next

            '引用元挿入
            bodyv.Add("<br>引用元：<a href=""" & urlv & """>" & lstrtitle & "</a>")
        Catch ex As Exception

        End Try
    End Sub

    'レス最初位置    'My検索関数
    Private Function StartMyIndexOf(ByVal strVar As String, ByVal Itinum As Integer)
        '文字列内に指定の文字がいくつあるか調べる
        Dim lintKazu As Integer = 0
        Dim intArray(30) As Integer
        Dim lintCnt As Integer = 0
        For i As Integer = 0 To 30
            intArray(i) = 999999999
        Next

        For i As Integer = 1 To 9
            If IKUTU2(strVar, i) > 0 Then
                For k As Integer = 0 To IKUTU2(strVar, i) - 1
                    lintKazu = MyIndexOf2(strVar, k, i)
                    For j As Integer = lintKazu To 0 Step -1
                        If strVar(j) = "<" Then
                            intArray(lintCnt) = j
                            lintCnt += 1
                            Exit For
                            'Return j
                        End If
                    Next
                Next
            End If
        Next

        Array.Sort(intArray)

        Dim lintCnt2 As Integer = 0
        Dim s As String
        For Each s In intArray
            If lintCnt2 = Itinum Then
                Return s
            End If
            lintCnt2 += 1
        Next
    End Function

    '相手数字ゲット
    Private Function getAiteSuji(ByVal strVar As String, ByVal Itinum As Integer) As Integer
        Dim lstrKaesi As String
        Dim lintIti As Integer
        '開始位置取得
        lintIti = MyIndexOf(strVar, Itinum)

        If strVar.Length - lintIti <= 5 Then
            '文なし
            Return -1
        End If

        lstrKaesi = strVar.Substring(lintIti + 8, 1)

        '2桁目
        If IsNumeric(strVar.Substring(lintIti + 9, 1)) Then
            lstrKaesi += strVar.Substring(lintIti + 9, 1)
        End If

        '3桁目
        If IsNumeric(strVar.Substring(lintIti + 10, 1)) Then
            lstrKaesi += strVar.Substring(lintIti + 10, 1)
        End If

        Return lstrKaesi
    End Function

    'My検索関数
    Private Function MyIndexOf(ByVal strVar As String, ByVal Itinum As Integer)
        '文字列内に指定の文字がいくつあるか調べる
        Dim lintKazu As Integer = 0
        Dim intArray(30) As Integer
        Dim lintCnt As Integer = 0

        For i As Integer = 0 To 30
            intArray(i) = 999999999
        Next

        For i As Integer = 1 To 9

            If IKUTU2(strVar, i) > 0 Then
                For k As Integer = 0 To IKUTU2(strVar, i) - 1
                    intArray(lintCnt) = MyIndexOf2(strVar, k, i)
                    lintCnt += 1
                    'Return j
                Next
            End If
        Next

        Array.Sort(intArray)

        Dim lintCnt2 As Integer = 0
        Dim s As Integer
        For Each s In intArray
            If lintCnt2 = Itinum Then
                Return s
            End If
            lintCnt2 += 1
        Next

        'For i As Integer = 1 To 9
        '    If MyIndexOf2(strVar, Itinum, i) <> -1 Then
        '        Return MyIndexOf2(strVar, Itinum, i)
        '    End If
        'Next
        'Return -1
    End Function

    'My検索関数　サブ
    Private Function MyIndexOf2(ByVal str As String, ByVal Knum As Integer, ByVal No As Integer)
        Dim lintIti As Integer = 0
        Dim lintIti2 As Integer = 0

        For i As Integer = 0 To Knum
            lintIti = str.IndexOf("&gt;&gt;" & No, lintIti2)
            If lintIti = -1 Then
                Return -1
            End If
            lintIti2 = lintIti + 1
        Next
        Return lintIti
        'Return str.IndexOf("&gt;&gt;" & No, Itinum)
    End Function


    'いくつか判定　メイン
    Private Function IKUTU(ByVal strVar As String) As Integer
        '文字列内に指定の文字がいくつあるか調べる
        Dim lintKazu As Integer = 0

        For i As Integer = 1 To 9
            lintKazu += IKUTU2(strVar, i)
        Next

        If lintKazu = 0 Then
            Return -1
        Else
            Return lintKazu
        End If
    End Function

    'いくつか判定　サブ
    Private Function IKUTU2(ByVal strVar As String, ByVal num As Integer) As Integer
        '文字列内に指定の文字がいくつあるか調べる
        Dim str1 As String = strVar
        Dim str2 As String = "&gt;&gt;" & num
        Dim lintKazu As Integer = 0

        lintKazu = ((str1.Length - str1.Replace(str2, "").Length) \ str2.Length)  '結果  4


        Return lintKazu
    End Function

    Public Sub shutokuITA(ByVal urlv As String, ByRef titlev As String, ByRef bodyv As Object)

        Dim client As System.Net.WebClient = New System.Net.WebClient()
        Dim url As String

        url = urlv

        '指定したURLからデータを取得する

        Dim wkStream As System.IO.Stream = _
                    client.OpenRead(url)



        'エンコード指定で文字列を取得する

        'サイトによってエンコードは異なる

        'Dim sr As StreamReader = New StreamReader(wkStream, _
        '    System.Text.Encoding.GetEncoding("utf-8"))

        'start

        Dim line As String = ""
        Dim al As New ArrayList
        Using sr As StreamReader = New StreamReader( _
          wkStream, Encoding.GetEncoding("Shift_JIS"))

            line = sr.ReadLine()
            Do Until line Is Nothing
                al.Add(line)
                line = sr.ReadLine()
            Loop

        End Using
        'end


        'Dim html As String = sr.ReadToEnd()


        'sr.Close()

        ''内容を一文字ずつ読み込む
        'While sr.Peek() > -1

        '    cstrHTML(cintHTMLCnt) = (sr.ReadLine())
        '    cintHTMLCnt += 1
        'End While


        wkStream.Close()

        Debug.WriteLine(al)

        'タイトル処理
        Dim lstrtitle As String
        Dim lintkaishi As Integer = 0
        Dim lintushiro As Integer = 0

        lstrtitle = al(36).ToString

        'Dat落ちなら終了
        If lstrtitle.Length <= 4 Then
            Exit Sub
        End If

        For i As Integer = 0 To lstrtitle.Length - 1
            If lstrtitle(i) = ">" Then
                lintkaishi += 1
                If lintkaishi = 1 Then
                    lintkaishi = i
                End If
            End If
        Next
        lintushiro = lstrtitle.Length - lintkaishi - 5

        lstrtitle = lstrtitle.Substring(lintkaishi)
        lstrtitle = lstrtitle.Substring(0, lintushiro)

        titlev = lstrtitle

        '本文処理
        Dim a As New ArrayList
        bodyv = a
        For i As Integer = 0 To al.Count - 1
            If al(i).ToString.Length > 4 Then
                If al(i).substring(0, 4) = "<dt>" Then
                    bodyv.Add(al(i))
                End If
            End If
        Next

        '色変え処理
        Dim lintkaisiColor As Integer = 0
        Dim lstrBun As String

        For i As Integer = 0 To bodyv.Count - 1
            If Rnd() * 100000 Mod 2 >= 1 Then
                lstrBun = bodyv(i).ToString
                lintkaisiColor = 0
                For j As Integer = 0 To lstrBun.Length - 1

                    If lstrBun(j) = ">" Then
                        lintkaisiColor += 1
                        If lintkaisiColor = 6 Then
                            lintkaisiColor = j
                            Exit For
                        End If
                    End If
                Next
                If Rnd() * 100000 Mod 2 >= 1 Then
                    'red
                    bodyv(i) = lstrBun.Substring(0, lintkaisiColor + 1) & "<font color=red size=3>" & lstrBun.Substring(lintkaisiColor + 2, lstrBun.Length - lintkaisiColor - 2) & "</font>"
                Else
                    'blue
                    bodyv(i) = lstrBun.Substring(0, lintkaisiColor + 1) & "<font color=blue size=3>" & lstrBun.Substring(lintkaisiColor + 2, lstrBun.Length - lintkaisiColor - 2) & "</font>"
                End If

            End If
        Next

        '引用元挿入
        bodyv.Add("<br>引用元：<a href=""" & urlv & """>" & lstrtitle & "</a>")

    End Sub

    ''' -----------------------------------------------------------------------------
    ''' <summary>
    '''     文字列が数値であるかどうかを返します。</summary>
    ''' <param name="stTarget">
    '''     検査対象となる文字列。<param>
    ''' <returns>
    '''     指定した文字列が数値であれば True。それ以外は False。</returns>
    ''' -----------------------------------------------------------------------------
    Public Overloads Shared Function IsNumeric(ByVal stTarget As String) As Boolean
        Return Double.TryParse( _
            stTarget, _
            System.Globalization.NumberStyles.Any, _
            Nothing, _
            0.0# _
        )
    End Function
End Class
