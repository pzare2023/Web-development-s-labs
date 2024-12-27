#!/usr/bin/perl -wT
use CGI':standard';
use strict;
use CGI::Carp qw(warningsToBrowser fatalsToBrowser);
use File::Basename; 
$CGI::POST_MAX = 1024 * 5000; 


my $safe_filename_characters = "a-zA-Z0-9_.-"; 
my $upload_dir = "../upload"; 

my $cgi = CGI->new;




my $first_name = $cgi->param('first_name');
my $last_name = $cgi->param('last_name');
my $address = $cgi->param('address');
my $city = $cgi->param('city');
my $postal_code = $cgi->param('postal_code');
my $province = $cgi->param('province');
my $phone = $cgi->param('phone');
my $email = $cgi->param('email');
my $photo = $cgi->param('photo');
my $filename = $cgi->param("photo");


if (!$filename) {
    print $cgi->header;
    print "There was a problem uploading your picture (try a smaller file).";
    exit;
}

my ($name, $path, $extension) = fileparse($filename, '\..*');
$filename = $name . $extension;
$filename =~ tr/ /_/; 
$filename =~ s/[^$safe_filename_characters]//g;

my $upload_filehandle = $cgi->upload("photo");

open (UPLOADFILE, ">$upload_dir/$filename") or die "$!";
binmode UPLOADFILE;
while (<$upload_filehandle>) {
    print UPLOADFILE;
}
close UPLOADFILE;


my %errors;


$errors{'phone'} = "Phone number must be 10 digits." unless $phone =~ /^\d{10}$/;
$errors{'postal_code'} = "Postal code must be in the format A1A 1A1." unless $postal_code =~ /^[A-Za-z]\d[A-Za-z] \d[A-Za-z]\d$/;
$errors{'email'} = "Invalid email address." unless $email =~ /^[\w\.\-]+@[a-zA-Z\d\-]+\.[a-zA-Z]{2,}$/;

print $cgi->header(-type => 'text/html', -charset => 'UTF-8');

if (%errors) {
    print $cgi->start_html(-title => "Error in Registration");
    print "<h2>Form Submission Errors</h2><ul>";
    foreach my $field (keys %errors) {
        print "<li><strong>$field:</strong> $errors{$field}</li>";
    }
    print "</ul><a href='https://cs.torontomu.ca/~pzare/lab07b.html'>Go back to the form</a>";
    print $cgi->end_html;
} else {
    print $cgi->start_html(-title => "Registration Success");
    print <<HTML;
    <h2>Registration Success</h2>
    <p><strong>First Name:</strong> $first_name</p>
    <p><strong>Last Name:</strong> $last_name</p>
    <p><strong>Address:</strong> $address</p>
    <p><strong>City:</strong> $city</p>
    <p><strong>Postal Code:</strong> $postal_code</p>
    <p><strong>Province:</strong> $province</p>
    <p><strong>Phone:</strong> $phone</p>
    <p><strong>Email:</strong> $email</p>
    <div><img src="/~pzare/upload/$filename" alt="Uploaded Image" style="width:200px;height:auto;"></div>
    <a href='https://cs.torontomu.ca/~pzare/lab07b.html'>Return to form</a>
HTML
    print $cgi->end_html;
}


print <<'CSS';
 <style>
    body{
      background-color: rgb(255, 173, 211);
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }
    h2{
     
      color: white;
      margin: 20;
      padding: 20;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      border: 2px white dashed;
     

    }
    div{
     
      color: white;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      
    }

    button {
    width: 100%;
    padding: 10px;
    background-color: #d769ff;
    color: white;
    border: none;
    cursor: pointer;
    font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    button:hover {
    background-color: #eb9cff;
    }
    
  </style>
CSS
