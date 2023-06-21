<?php

$client_id=1;
if(isset($_POST['booking_id'])){
    $booking_id=$_POST['booking_id'];
}
$booking_id=72;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="chat-button">
    <div id="close">
                    <svg  width="20" height="20" viewBox="0 0 8 8" fill="#323232" xmlns="http://www.w3.org/2000/svg">
                      <path d="M6.59 0L4 2.59L1.41 0L0 1.41L2.59 4L0 6.59L1.41 8L4 5.41L6.59 8L8 6.59L5.41 4L8 1.41L6.59 0Z"/>
                    </svg>
    </div>
        <div id="contenaire">
            <div id="zone" class="message-zone">
                <div id="oikos">
                    <img src="../img/OIKOS.svg" alt="">
                   
                    

                    
                </div>
                <div id="espace-messages">
                <div  class=' recever_box '><div class='row'><div class='circle_image'></div><div class='receiver bullemessage draggableElement' id="+getData[i].id+" data-id="+getData[i].id+"  ><p>hello tu vas bien?</p></div></div><div class='time'></div></div>
                </div>
                <div id="write-zone">
                    <input type="text" id="message" placeholder="ecrivez un message ...">
                    <button id="send">
                        <svg id="arrow" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 0L6.59 1.41L12.17 7H0V9H12.17L6.59 14.59L8 16L16 8L8 0Z" fill="#323232"/></svg>
                    </button>
                </div>
                
            </div>
        </div>

    </div>
   
    <script>
        var send=document.getElementById('send');
        var arrow=document.getElementById('arrow');
        send.addEventListener('click',()=>{
             arrow.classList.toggle('zap');
             setTimeout(()=>{
                 arrow.classList.remove('zap');
             },800)
        })
    </script>
    <script >

    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_message.php?client_id='+<?php echo $client_id; ?>+'&booking_id='+<?php echo $booking_id ?>, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            var getData = JSON.parse(xhr.responseText);
            console.log(getData);
            espace_message.innerHTML="";
            for (let i = 0; i < getData.length; i++) {
                if(getData[i].sender_id==<?php echo $client_id; ?>){
                    espace_message.innerHTML +=" <div  class=' sender_box '><div class='row'><div class='sender bullemessage draggableElement'  data-id="+getData[i].client_id+"  ><p>"+getData[i].message+"</p></div></div><div class='time'></div></div>";
                }else{
                    espace_message.innerHTML +=" <div  class=' recever_box '><div class='row'><div class='circle_image'></div><div class='receiver bullemessage draggableElement'  data-id="+getData[i].client_id+"  ><p>"+getData[i].message+"</p></div></div><div class='time'></div></div>";
                }
               
            }
           
        }
        else {
            alert('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();




        var conn = new WebSocket('ws://localhost:8080?identifiant=<?php echo $booking_id; ?>');
var espace_message = document.getElementById('espace-messages');
const message = document.getElementById('message');
const write_zone = document.getElementById('write-zone');
const contenaire = document.getElementById('contenaire');
const message_zone = document.getElementById('zone');
const closes = document.getElementById('close');
var etat = false;
conn.onopen = function(e) {
    console.log("Connection established!");
    var room = <?php echo $booking_id; ?>;
    var joinMessage = {
    type: 'join',
    room: room
  };
  conn.send(JSON.stringify(joinMessage));
    console.log("Connection established!");
}
conn.onmessage = function(e) {
    console.log(e.data);
    var data = JSON.parse(e.data);
    if(data.id!==<?php echo $client_id; ?>){
        espace_message.innerHTML +=" <div  class=' sender_box '><div class='row'><div class='sender bullemessage draggableElement'  data-id="+data.id+"  ><p>"+data.msg+"</p></div></div><div class='time'></div></div>";
    }else{
        espace_message.innerHTML +=" <div  class=' recever_box '><div class='row'><div class='circle_image'></div><div class='receiver bullemessage draggableElement'  data-id="+data.id+"  ><p>"+data.msg+"</p></div></div><div class='time'></div></div>";
    }

    
    check();
  
}

send.onclick = function() {
    let msg = message.value;
    var id= 0;
    room = <?php echo $booking_id; ?>;
    var content = {
            type: "message",
              msg: msg,
              id: id,
              room: room,
              time: Date.now(),}
              console.log(content);
              conn.send(JSON.stringify(content));
              console.log(content);
   
   
    //save message in database
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'save_message.php?client_id='+<?php echo $client_id; ?>+'&message='+msg+'&booking_id='+<?php echo $booking_id ?>, true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            console.log(xhr.responseText);
        }
        else {
            alert('Request failed.  Returned status of ' + xhr.status);
        }
    };
    xhr.send();

    
    espace_message.innerHTML +=" <div  class=' recever_box '><div class='row'><div class='circle_image'></div><div class='receiver bullemessage draggableElement' id=ee data-id=ee  ><p>"+message.value+"</p></div></div><div class='time'></div></div>";
    message.value = "";
}

write_zone.addEventListener("keyup", function(event) {
    if (event.keyCode === 13) {
        event.preventDefault();
        send.click();
    }
}
);

contenaire.onclick = function() {
    document.getElementById('oikos').children[0].classList.add('lueur');
    setTimeout(()=>{
        document.getElementById('oikos').children[0].classList.remove('lueur');
    },1000)
    etat = true;
    contenaire.style.background = "none";
    contenaire.style.height = "100vh";
    contenaire.style.width = "100%";
    message_zone.classList.add("visible");
    check();
}

closes.onclick = function() {
    message_zone.classList.remove("visible");
    contenaire.style.background = "#f07d3b";
    contenaire.style.height = "50px";
    contenaire.style.width = "50px";
   console.log("close");
    etat = false;
   check();
}

function check(){
    if (etat == true) {
        closes.style.opacity="1";
    } else {
        closes.style.opacity="0";
    }
}
//make message_zone draggable
dragElement(document.getElementById("close"));

function dragElement(elmnt) {
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;

    elmnt.onmousedown = dragMouseDown;

    function dragMouseDown(e) {
        e = e || window.event;
        e.preventDefault();

        pos3 = e.clientX;
        pos4 = e.clientY;

        document.onmouseup = closeDragElement;

        document.onmousemove = elementDrag;
    }

    function elementDrag(e) {
        e = e || window.event;
        e.preventDefault();

        pos1 = pos3 - e.clientX;
        pos2 = pos4 - e.clientY;

        pos3 = e.clientX;
        pos4 = e.clientY;

        elmnt.style.top = (elmnt.offsetTop - pos2) + "px";
        elmnt.style.left = (elmnt.offsetLeft - pos1) + "px";

    }

    function closeDragElement() {
        document.onmouseup = null;
        document.onmousemove = null;
    }
}


    </script>
</body>
</html>