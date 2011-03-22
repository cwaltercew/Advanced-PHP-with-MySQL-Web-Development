1.) As http is the common opening to most URLs. I have added "http://" as an initial value in the url field.
2.) The email field did not accept my email address, so I replaced its regex with one that accepted more valid email addresses.
3.) I edited the validation to consistently use the more efficient perl regex.
4.) I added strip slashes to the cleanup function.
