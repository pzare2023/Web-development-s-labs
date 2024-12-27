#!/usr/bin/perl -wT
use CGI':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);


print header(-type => 'text/html', -charset => 'UTF-8');

print start_html(
    -title => 'My First Perl Program',
    -style => { -src => 'https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap' }
);

print <<'CSS';
<style>
    body {
        font-family: 'Roboto', sans-serif; 
        height: 100vh;
        margin: 0;
    }
    .center-text {
        color: #4CAF50; 
        font-size: 40px; 
        text-align: center;
    }
</style>
CSS

# HTML content
print <<'HTML';
<div class="center-text">This is my first Perl program</div>
HTML

# End HTML
print end_html;
