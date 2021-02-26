window.addEventListener('load', function(){
    document.getElementById('loader').classList.add('fadeOut');
});


if( document.querySelector('#edit_img_admin') ){

    document.querySelector('#edit_img_admin').addEventListener('change', function(e){
        const nameImg =  e.target.files[0].name;
        let reader = new FileReader();
    
        reader.onload = function(e){
            document.querySelector('.img-thumbnail').setAttribute('src', e.target.result);
        }
    
        reader.readAsDataURL(e.target.files[0]);
    
        e.target.nextElementSibling.innerText = nameImg;
    });
}

if( document.querySelector('#edit_img_user') ){

    document.querySelector('#edit_img_user').addEventListener('change', function(e){
        const nameImg =  e.target.files[0].name;
        let reader = new FileReader();
    
        reader.onload = function(e){
            document.querySelector('.img-thumbnail').setAttribute('src', e.target.result);
        }
    
        reader.readAsDataURL(e.target.files[0]);
    
        e.target.nextElementSibling.innerText = nameImg;
    });
}

if( document.querySelector('#edit_img_laptop') ){

    document.querySelector('#edit_img_laptop').addEventListener('change', function(e){
        const nameImg =  e.target.files[0].name;
        let reader = new FileReader();
    
        reader.onload = function(e){
            document.querySelector('.img-thumbnail').setAttribute('src', e.target.result);
        }
    
        reader.readAsDataURL(e.target.files[0]);
    
        e.target.nextElementSibling.innerText = nameImg;
    });
}

if( document.querySelector('#img_laptop') ){

    document.querySelector('#img_laptop').addEventListener('change', function(e){
        const nameImg =  e.target.files[0].name;
        e.target.nextElementSibling.innerText = nameImg;
    });
}


if( document.querySelector('.table-dashboard') ){
    setInterval(() => {
        window.location.href = '/dashboard';
    }, 15000);
}
document.querySelector('#sidebarToggle').addEventListener('click', function(){
    document.querySelector('body').classList.toggle('sidebar-toggled');
    document.querySelector('.sidebar').classList.toggle('toggled');
});

document.querySelector('#sidebarToggleTop').addEventListener('click', function(){
    document.querySelector('body').classList.toggle('sidebar-toggled');
    document.querySelector('.sidebar').classList.toggle('toggled');
});

document.addEventListener('click', function (e) {
    if (e.target.className === 'close' || e.target.className === 'span-close') {
        document.querySelector('.alert-dismissible').style.display = 'none';
    }
});