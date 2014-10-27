Public Class test

    Private Sub Button1_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles Button1.Click
        Try
            Dim lstrtitle As String
            Dim lstrBody As String

            Dim lcls As New resufurikae

            lcls.shutoku("", lstrtitle, lstrBody)
            RichTextBox1.Text += lstrtitle & vbCrLf
            RichTextBox1.Text += lstrBody
        Catch ex As Exception
            MsgBox(ex.ToString)
        End Try
    End Sub
End Class