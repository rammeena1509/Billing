var myFunction = function() {
  window.open('http://khaanpan.com/admin/order/', '_blank')
};
var myImg = "https://unsplash.it/600/600?image=777";

function fetchOrderCount() {
	$.post(link+"adminrequest/getCount/",function(data){
        if(data>count){
            count++;
            getNotify();
        }
	});
  
}

function getNotify() {
  var options = {
    title: "New Order",
    options: {
      body: "New Order Received",
      icon: myImg,
      lang: 'en-US',
      onClick: myFunction
    }
  };
  console.log(options);
  $("#easyNotify").easyNotify(options);
  var x=document.getElementById("soundFX");
		x.play();
}

function notice(){
		setInterval(fetchOrderCount, 1000);
	}