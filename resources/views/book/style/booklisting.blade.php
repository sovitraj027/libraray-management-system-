<style>
    @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");

    * {
        box-sizing: border-box;
    }

    body {
        /* display: flex; */
        justify-content: center;
        align-items: center;
        margin: 0;
        background-color: #f7f8fc;
        font-family: "Roboto", sans-serif;
        color: #10182f;
    }

    .container {
        display: flex;
        /* width:1289px; */
        justify-content: space-evenly;
        flex-wrap: wrap;
    }

    .card {
        margin: 5px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
        width: 300px;
        /* height: 450px; */
    }

    .card-header img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 20px;
        min-height: 200px;
    }

    .tag {
        background: #cccccc;
        border-radius: 50px;
        font-size: 12px;
        margin: 0;
        color: #fff;
        padding: 2px 10px;
        text-transform: uppercase;
        cursor: pointer;
    }

    .tag-teal {
        background-color: #47bcd4;
    }

    .tag-purple {
        background-color: #5e76bf;
    }

    .tag-pink {
        background-color: #cd5b9f;
    }

    .card-body p {
        font-size: 13px;
        margin: 0 0 5px;
    }
    .rating {
    color: #fd9300;
    margin-right: auto;
    margin-top: 10px;
    }

    .user {
        display: flex;
        margin-top: 5px;
    }

    .user img {
        border-radius: 50%;
        width: 40px;
        height: 40px;
        margin-right: 10px;
    }

    .user-info h5 {
        margin: 0;
    }

    .user-info small {
        color: #545d7a;
    }
</style>