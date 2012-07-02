function hidecaptcha()
{
    var captchaElements = document.getElementsByClassName('captcha');
    
    for (var i = 0; i < captchaElements.length; i++) {
	captchaElements[i].style.visibility = 'hidden';
    }
}


function showcaptcha()
{    
    var captchaElements = document.getElementsByClassName('captcha');
    
    for (var i = 0; i < captchaElements.length; i++) {
	captchaElements[i].style.visibility = 'visible';
    }
}
