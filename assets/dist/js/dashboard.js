window.onload = function () {

    var selectBox = document.getElementById("selectBox");
    var a = document.getElementById("month-sel");
    var b = document.getElementById("quarter-sel");
    var c = document.getElementById("year-sel");
        selectBox.addEventListener('change', changeFunc);
        function changeFunc() {
            if(this.value == "Monthly"){
                a.style.display = "block";
                b.style.display = "none";
                c.style.display = "block";
            }else if (this.value == "Quarterly") {
                a.style.display = "none";
                b.style.display = "block";
                c.style.display = "block";
            }else if (this.value == "Yearly") {
                a.style.display = "none";
                b.style.display = "none";
                c.style.display = "block";
            }
            ;
        }


    var selectBox2 = document.getElementById("selectBox2");
    var d = document.getElementById("month-sel2");
    var e = document.getElementById("quarter-sel2");
    var f = document.getElementById("year-sel2");
        selectBox2.addEventListener('change', changeFunc2);
        function changeFunc2() {
            if(this.value == "Monthly"){
                d.style.display = "block";
                e.style.display = "none";
                f.style.display = "block";
            }else if (this.value == "Quarterly") {
                d.style.display = "none";
                e.style.display = "block";
                f.style.display = "block";
            }else if (this.value == "Yearly") {
                d.style.display = "none";
                e.style.display = "none";
                f.style.display = "block";
            }
            ;
        }
}