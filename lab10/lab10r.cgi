#!/usr/bin/ruby

require 'cgi'
cgi = CGI.new


city = cgi['city'].capitalize
province = cgi['province'].capitalize
country = cgi['country'].capitalize
image_url = cgi['image_url']


puts "Content-type: text/html\n\n"
puts <<HTML
<!DOCTYPE html>
<html>
<head>
    <title>City Information</title>
    <style>
        body {
            background-color: lightblue;
            text-align: center;
        }
        img {
            width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1 style="background-color: darkblue; color: white; padding: 20px;">#{city}, #{country}</h1>
    <p>Province/State: #{province}</p>
    <img src="#{image_url}" alt="City Picture">
</body>
</html>
HTML