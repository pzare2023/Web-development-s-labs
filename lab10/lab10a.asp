<%
' Retrieve the background color from the query string
Dim bgColor
bgColor = Request.QueryString("bg") ' Use "bg" as the parameter name

' Set a default background color if no query string value is provided
If bgColor = "" Then
    bgColor = "white"
End If

' Manage cookies to track the last visit
Dim lastVisit, currentVisit
currentVisit = Now()

If Request.Cookies("LastVisit") <> "" Then
    lastVisit = Request.Cookies("LastVisit")
Else
    lastVisit = "First time visiting"
End If

' Update the cookie with the current date and time
Response.Cookies("LastVisit") = currentVisit

' Generate the page with the specified background color and last visit info
Response.Write("<!DOCTYPE html>")
Response.Write("<html>")
Response.Write("<head><title>Lab 10a</title></head>")
Response.Write("<body style='background-color:" & bgColor & ";'>")
Response.Write("<h1>Welcome to the Classic ASP Page!</h1>")
Response.Write("<p>Background color: " & bgColor & "</p>")
Response.Write("<p>Last visit: " & lastVisit & "</p>")
Response.Write("<p>Current visit: " & currentVisit & "</p>")
Response.Write("</body>")
Response.Write("</html>")
%>
