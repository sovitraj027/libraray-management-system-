
<style>
    *{
        margin: 0;
        padding: 0;
        font-family: sans-serif;
    }
    .banner{
        width: 100%;
        height: 100%;
        background-image: linear-gradient(rgba(0,0,0,0.75),rgba(0,0,0,0.75)),url('assets/images/background.jpg');  
        background-size: cover;
        background-position: center;
    }
    .content{
        width: 100%;
        position: absolute;
        top: 30%;
        transform:translate(-30%);
        text-align: right;
        color: #fff;
    }
    .content h1{
        font-size: 70px;
    }
    .content p{
        margin: 20px auto;
        font-weight: 100;
        line-height: 20px;
        text-align:end;
    }
    button{
        width: 200px;
        padding: 15px 0;
        text-align: center;
        margin: 20px 200px;
        border-radius: 25px;
        font-weight: bold;
        border: 2px solid #009688;
        background: transparent;
        color: #fff;
        cursor: pointer;
        overflow: hidden;
        position: relative;
    }
    span{
        background: #009688;
        height: 100%;
        width:0;
        border-radius: 25px;
        position: absolute;
        left: 0;
        bottom: 0;
        z-index: -1;
        transition: 0.5s;
    }
    button:hover span{
        width: 100%
    }
    button:hover{
        border: none;
    }
</style>

<body>
    <div class="banner">
        <div class="content">
            <h1>Welcome To Lms</h1>
            <form action="{{route('login')}}" method="GET">
                <div> 
                    <button  type="submit"> <span>  </span> login </button>
                </div>
            </form>
            
        </div>
        
    </div>
</body>
