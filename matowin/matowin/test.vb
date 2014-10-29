Public Class test

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Try
            Dim lstrtitle As String
            Dim larray As ArrayList
            Dim ldts As New DataSet

            'データセット
            ldts.Tables.Add("mato")
            ldts.Tables("mato").Columns.Add("no")
            ldts.Tables("mato").Columns.Add("honbun")


            Dim lcls As New resufurikae
            Dim lcslsonota As New clsSonotakako

            '振り分け
            lcls.shutoku("http://viper.2ch.sc/test/read.cgi/news4vip/1414438839/", lstrtitle, larray)
            RichTextBox1.Text += lstrtitle & vbCrLf

            'アンカー加工
            lcslsonota.ankar(larray)

            ' アプリケーション起動直後はドキュメントが存在しない
            If WebBrowser1.Document = Nothing Then
                WebBrowser1.Navigate("about:blank") ' 空白ページを開く
            End If
            For i As Integer = 0 To larray.Count - 1
                RichTextBox1.AppendText(larray(i).ToString & vbCrLf)
                WebBrowser1.Document.Write(larray(i).ToString & vbCrLf)
            Next


        Catch ex As Exception
            MsgBox(ex.ToString)
        End Try
    End Sub
End Class