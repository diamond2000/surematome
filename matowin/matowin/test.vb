Public Class test

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Try
            Dim lstrtitle As String
            Dim larray As ArrayList

            Dim lcls As New resufurikae

            lcls.shutoku("http://viper.2ch.sc/test/read.cgi/news4vip/1414438839/", lstrtitle, larray)
            RichTextBox1.Text += lstrtitle & vbCrLf
            For i As Integer = 0 To larray.Count - 1
                RichTextBox1.AppendText(larray(i).ToString)
            Next
        Catch ex As Exception
            MsgBox(ex.ToString)
        End Try
    End Sub
End Class