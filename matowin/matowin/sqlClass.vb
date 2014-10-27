Imports System.Data.SqlClient

Public Class sqlClass

    Private connection As SqlConnection
    Private adapter As SqlDataAdapter
    Private ds As DataSet

    Public Sub selectData(ByVal strSql As String, ByRef dtsData As DataSet)

        '接続する端末名
        Dim ServerName As String = Environment.MachineName & "\SQLEXPRESS"
        '接続するデータベース名
        Dim DBName As String = "matome"
        'ユーザ名
        Dim UserID As String = "sa"
        'パスワード
        Dim Password As String = "admin"

        connection = New System.Data.SqlClient.SqlConnection()
        'SQL Server認証を利用して接続
        'connection.ConnectionString = _
        ' "Data Source = " & ServerName & _
        ' ";Initial Catalog = " & DBName & _
        ' ";User ID = " & UserID & _
        ' ";Password = " & Password
        connection.ConnectionString = _
 "Data Source = " & ServerName & _
 ";Initial Catalog = " & DBName & _
 ";Integrated Security = SSPI"

        'DBへの接続
        connection.Open()

        'データの取得
        ds = New DataSet()

        Dim sql As String
        sql = strSql

        adapter = New SqlDataAdapter()
        adapter.SelectCommand = New SqlCommand(sql, connection)
        adapter.SelectCommand.CommandType = CommandType.Text
        adapter.Fill(ds)

        adapter.MissingSchemaAction = MissingSchemaAction.AddWithKey

        'ConvertDataTableToCsv(ds.Tables(0), "c:\test\" & strName & ".csv", True)
        If connection.State <> ConnectionState.Closed Then
            connection.Close()
        End If

        dtsData = ds.Copy

    End Sub

    Public Sub insertSQL(ByVal sqlBUN As String)
        '接続する端末名
        Dim ServerName As String = Environment.MachineName & "\SQLEXPRESS"
        '接続するデータベース名
        Dim DBName As String = "matome"
        'ユーザ名
        Dim UserID As String = "sa"
        'パスワード
        Dim Password As String = "admin"
        Using cn As SqlConnection = New SqlConnection()
            '   cn.ConnectionString = _
            '"Data Source = " & ServerName & _
            '";Initial Catalog = " & DBName & _
            '";User ID = " & UserID & _
            '";Password = " & Password
            cn.ConnectionString = _
     "Data Source = " & ServerName & _
     ";Initial Catalog = " & DBName & _
     ";Integrated Security = SSPI"
            cn.Open()
            Dim queryString As String = sqlBUN '"INSERT INTO tr_url  VALUES('http:2','" & Now & "')"
            Dim command As SqlCommand = New SqlCommand(queryString, cn)
            Dim ret As Integer = command.ExecuteNonQuery()
            Console.WriteLine("件数:" + ret.ToString())
        End Using
    End Sub



    'Private Sub Button2_Click( _
    '  ByVal sender As System.Object, _
    '  ByVal e As System.EventArgs) Handles Button2.Click

    '    '更新用SQLの取得
    '    Dim builder As SqlCommandBuilder = New SqlCommandBuilder(adapter)
    '    builder.GetUpdateCommand()
    '    Dim result As Integer

    '    'データの更新
    '    result = adapter.Update(ds.Tables(0))
    'End Sub




    ''' <summary>
    ''' DataTableの内容をCSVファイルに保存する
    ''' </summary>
    ''' <param name="dt">CSVに変換するDataTable</param>
    ''' <param name="csvPath">保存先のCSVファイルのパス</param>
    ''' <param name="writeHeader">ヘッダを書き込む時はtrue。</param>
    Public Sub ConvertDataTableToCsv( _
            ByVal dt As DataTable, ByVal csvPath As String, ByVal writeHeader As Boolean)
        'CSVファイルに書き込むときに使うEncoding
        Dim enc As System.Text.Encoding = _
            System.Text.Encoding.GetEncoding("Shift_JIS")

        '書き込むファイルを開く
        Dim sr As New System.IO.StreamWriter(csvPath, False, enc)

        Dim colCount As Integer = dt.Columns.Count
        Dim lastColIndex As Integer = colCount - 1
        Dim i As Integer

        'ヘッダを書き込む
        If writeHeader Then
            For i = 0 To colCount - 1
                'ヘッダの取得
                Dim field As String = dt.Columns(i).Caption
                '"で囲む
                field = EncloseDoubleQuotesIfNeed(field)
                'フィールドを書き込む
                sr.Write(field)
                'カンマを書き込む
                If lastColIndex > i Then
                    sr.Write(","c)
                End If
            Next
            '改行する
            sr.Write(vbCrLf)
        End If

        'レコードを書き込む
        Dim row As DataRow
        For Each row In dt.Rows
            For i = 0 To colCount - 1
                'フィールドの取得
                Dim field As String = row(i).ToString()
                '"で囲む
                field = EncloseDoubleQuotesIfNeed(field)
                'フィールドを書き込む
                sr.Write(field)
                'カンマを書き込む
                If lastColIndex > i Then
                    sr.Write(","c)
                End If
            Next
            '改行する
            sr.Write(vbCrLf)
        Next

        '閉じる
        sr.Close()
    End Sub

    ''' <summary>
    ''' 必要ならば、文字列をダブルクォートで囲む
    ''' </summary>
    Private Function EncloseDoubleQuotesIfNeed(ByVal field As String) As String
        If NeedEncloseDoubleQuotes(field) Then
            Return EncloseDoubleQuotes(field)
        End If
        Return field
    End Function

    ''' <summary>
    ''' 文字列をダブルクォートで囲む
    ''' </summary>
    Private Function EncloseDoubleQuotes(ByVal field As String) As String
        If field.IndexOf(""""c) > -1 Then
            '"を""とする
            field = field.Replace("""", """""")
        End If
        Return """" & field & """"
    End Function

    ''' <summary>
    ''' 文字列をダブルクォートで囲む必要があるか調べる
    ''' </summary>
    Private Function NeedEncloseDoubleQuotes(ByVal field As String) As Boolean
        Return field.IndexOf(""""c) > -1 OrElse _
            field.IndexOf(","c) > -1 OrElse _
            field.IndexOf(ControlChars.Cr) > -1 OrElse _
            field.IndexOf(ControlChars.Lf) > -1 OrElse _
            field.StartsWith(" ") OrElse _
            field.StartsWith(vbTab) OrElse _
            field.EndsWith(" ") OrElse _
            field.EndsWith(vbTab)
    End Function



End Class
