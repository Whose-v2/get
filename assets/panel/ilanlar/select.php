<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/js/fontawesome.min.js" integrity="sha512-5qbIAL4qJ/FSsWfIq5Pd0qbqoZpk5NcUVeAAREV2Li4EKzyJDEGlADHhHOSSCw0tHP7z3Q4hNHJXa81P92borQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<style>

    #left {
        background-color: rgb(0,0,0);
    background: linear-gradient(108deg, rgba(0,0,0,1) 19%, rgba(0,97,156,1) 52%, rgba(0,0,0,1) 84%);
    }

.select-row {
    background: rgb(0,97,156);
background: linear-gradient(108deg, rgba(0,97,156,1) 6%, rgba(0,0,0,1) 44%, rgba(26,98,159,1) 79%);
}

    .select-row {
        padding: 25px;
        margin-left: 250px;
    }
    .container{
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 10px;
    }

    .form-group {
        margin-top: 167px;
        width: 250px;
        height: 250px;
        background:#ffffff;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column-reverse;
        border-radius: 121px;
        color: black;
    }

    p.title {
        font-size: 30px;
        text-align: center;
    }

    .form-group i {
        font-size: 30px;
        color: black;
    }

    .form-group:hover{
        opacity: .6;
    }
</style>

<div class="select-row">
<h3 style="Color:white;">Ürün Seç</h3>
<div class="container">
    <div class="form-group">
        <p class="title">Telefon</p>
        <i class="fa-solid fa-mobile-button"></i>
    </div>
        <div class="form-group">
        <p class="title">Playstation</p>
        <i class="fa-solid fa-microchip"></i>
    </div>
    <div class="form-group">
        <p class="title">Bilgisayar</p>
        <i class="fa-solid fa-laptop"></i>
    </div>
    <div class="form-group">
        <p class="title">Param Guvende</p>
        <span style="margin-top: 15px">(Sadece Param Guvende Ekranı)</span>
        <i class="fa-regular fa-s"></i>
    </div>
    <div class="form-group">
        <p class="title">Televizyon</p>
        <i class="fa-solid fa-tv"></i>    
    </div>
    <div class="form-group">
        <p class="title">Kulaklik</p>
        <i class="fa-solid fa-headphones-simple"></i>
    </div>
    <a href="logout.php"><div class="form-group"
    
    style="background: rgb(0,97,156);
    background: linear-gradient(108deg, rgba(0,97,156,1) 0%, rgba(255,0,0,1) 45%, rgba(26,98,159,1) 98%);">


    <p class="title">Çıkış Yap</p>
    <i class="fas fa-sign-out-alt"></i>
    </div></a>
    
</div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.querySelectorAll('.form-group').forEach((item, index) => {
            item.addEventListener('click', () => {
                window.location.href = `${document.location.origin}${document.location.pathname}?page=ilanlar&action=${item.firstElementChild.textContent.replace(' ', '').toLowerCase().trim()}`
            })
        })
    })
</script>