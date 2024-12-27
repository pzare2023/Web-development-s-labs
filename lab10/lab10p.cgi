#!/usr/bin/python2

import cgi

# Get form data
form = cgi.FieldStorage()
city = form.getvalue('city', '').upper()
province = form.getvalue('province', '').upper()
country = form.getvalue('country', '').upper()
image_url = form.getvalue('image_url', '')

print('Content-type: text/html\n')
print('''
<!DOCTYPE html>
<html>
<head>
    <title>City Information</title>
    <style>
        body {{
            background-color: lightgreen;
            text-align: center;
        }}
        img {{
            width: 80%;
            height: auto;
            border: 10px solid darkgreen;
        }}
    </style>
</head>
<body>
    <h1 style="background-color: darkgreen; color: white; padding: 20px;">{city}, {country}</h1>
    <p>Province/State: {province}</p>
    <img src="{image_url}" alt="City Picture">
</body>
</html>
'''.format(city=city, province=province, country=country, image_url=image_url))
