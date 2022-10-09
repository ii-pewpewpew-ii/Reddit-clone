
        function show(){
            var x = document.getElementById('lpassword');
            if(x.type === "password"){
                x.type = 'text';
            }
            else{
                x.type = 'password';
            }
        }
        var form = document.getElementById("form");
        var btn = document.getElementById("show");
        var span = document.getElementsByClassName("close")[0];
        btn.onclick = function() {
        form.style.display = "block";
        }
        span.onclick = function() {
            form.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == form) {
                form.style.display = "none";
            }
        }
        var form1 = document.getElementById("form2");
        var btn1 = document.getElementById("show1");
        var span1 = document.getElementsByClassName("close")[1];
        btn1.onclick = function() {
        form1.style.display = "block";
        }
        span1.onclick = function() {
            form1.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == form1) {
                form1.style.display = "none";
            }
        }
