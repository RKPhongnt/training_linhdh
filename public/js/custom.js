$(function(){

	// preview avatar upload
	$('.upload-avatar').on('change',function(evt){
		var selectedImage = evt.currentTarget.files[0];
		var imageWrapper = $('.avatar');
		var theImage = document.createElement('img');
		imageWrapper.html('');
		 
		var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.jpg|.jpeg|.gif|.png|.bmp)$/;
		if (regex.test(selectedImage.name.toLowerCase())) {
		    if (typeof(FileReader) != 'undefined') {
		        var reader = new FileReader();
		        reader.onload = function(e) {
		            theImage.classList.add = 'avatar';
		            theImage.classList.add = 'circle';
		            theImage.src = e.target.result;
		            imageWrapper.append(theImage);
		            console.log(theImage);
		        }
		        //
		        reader.readAsDataURL(selectedImage);
		    } else {
		        console.log('browser support issue');
		    }
		} else {
		    $(this).prop('value', null);
		    console.log('please select and image file');
		}
	})
})
