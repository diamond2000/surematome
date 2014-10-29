Imports System.Web.Services
Imports System.Web.Services.Protocols
Imports System.ComponentModel

' この Web サービスを、スクリプトから ASP.NET AJAX を使用して呼び出せるようにするには、次の行のコメントを解除します。
' <System.Web.Script.Services.ScriptService()> _
<System.Web.Services.WebService(Namespace:="http://tempuri.org/")> _
<System.Web.Services.WebServiceBinding(ConformsTo:=WsiProfiles.BasicProfile1_1)> _
<ToolboxItem(False)> _
Public Class Service1
    Inherits System.Web.Services.WebService

    <WebMethod()> _
    Public Function HelloWorld() As String
       Return "Hello World"
    End Function

    <WebMethod()> _
   Public Function matotest(ByVal str As String) As String
        Dim lstrtitle As String
        Dim larray As ArrayList
        Dim lstrHTML As String



        Dim lcls As New resufurikae

        '振り分け
        lcls.shutoku("http://viper.2ch.sc/test/read.cgi/news4vip/1414438839/", lstrtitle, larray)
        lstrHTML += lstrtitle & vbCrLf

        For i As Integer = 0 To larray.Count - 1

            lstrHTML += larray(i).ToString & vbCrLf
        Next

        Return str & lstrHTML
    End Function

End Class