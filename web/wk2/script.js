function clickBtn() {
    alert("Clicked");
    
    let btn = document.getElementById('btn1');
    if(btn.innerHTML == "Click Me!") {
    btn.innerHTML = "Clicked";
    }
    else{
        btn.innerHTML = "Click Me!";
    }

}

function changeColor() {
    let color = document.getElementById('color').value;
    let div = document.getElementById('div1');

    div.style.backgroundColor = color;

    

}