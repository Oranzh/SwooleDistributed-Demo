<head>
    <style>
        $background: #111E25;
        $dark: #111;
        $primary: #bb1515;

        input,
        button {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -300%);
            display: block;
            width: 70vw;
            opacity: 0;
            pointer-events: none;
            transition: all .5s cubic-bezier(.4, .25, .8, .3);
        }

        input {
            padding: .25rem 0;
            border: 0;
            border-bottom: 1px solid $primary;
            outline: 0;
            background: transparent;
            color: #fff;
            font-size: 3rem;
            line-height: 4rem;
            letter-spacing: .125rem;
            transition: all .5s cubic-bezier(.4, .25, .8, .3);
        }

        input::selection {
            background: rgba($primary, 0.25);
        }

        button,
        .signup-button {
            padding: .25em 0;
            border: 0;
            outline: 0;
            background: $primary;
            color: rgba(#fff, 0.85);
            font-size: 2rem;
            line-height: 3.6rem;
            letter-spacing: .0625rem;
            box-shadow: 0 3px 5px 1px rgba(#000, 0.25);
            text-shadow: 0 -2px 0 rgba(#000, 0.25), 0 1px 0 rgba(#fff, 0.2);
        }

        input:focus,
        button:focus {
            opacity: 1;
            transform: translate(-50%, -100%);
            pointer-events: auto;
            transition: all .4s cubic-bezier(.1, .45, .1, .85) .5s;
            z-index: 10;
        }

        input:focus ~ input,
        input:focus ~ button {
            transform: translate(-50%, 500%);
            transition: all .5s ease-in;
        }
        input:focus ~ label .label-text {
            transform: translate(-50%, 300%);
            transition: all .5s ease-in;
        }
        input:focus ~ .tip {
            opacity: 1;
        }
        input:focus ~ .signup-button,
        button:focus ~ .signup-button {
            opacity: 0;
        }

        input:focus + label .label-text {
            opacity: 1;
            transform: translate(-50%, -100%);
            transition: all .3s cubic-bezier(.1, .45, .1, .85) .4s;
        }
        input:focus + label .nav-dot:before {
            background: darken($primary, 5%);
            box-shadow: 0 0 0 .15rem $dark, 0 0 .05rem .26rem $primary;
        }

        .tip {
            position: fixed;
            top: 57%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 70%;
            opacity: 0;
            color: #fff;
            font-size: .875rem;
            font-weight: 300;
            letter-spacing: .125rem;
            text-transform: uppercase;
            text-align: right;
            transition: opacity .25s .5s;
        }

        .signup-button,
        .signup-button-trigger {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -100%);
            width: 70vw;
            padding: .25rem 0;
            line-height: 3.6rem;
            text-align: center;
            pointer-events: none;
            cursor: pointer;
            transition: opacity .4s .3s;
        }

        .signup-button-trigger {
            opacity: 0;
            pointer-events: auto;
        }

        .label-text {
            position: fixed;
            top: calc(50% - 4rem);
            left: 50%;
            transform: translate(-50%, -300%);
            width: 70vw;
            padding: 3.125rem 0 1.5rem;
            text-transform: uppercase;
            color: #fff;
            opacity: 0;
            font-size: 1.125rem;
            font-weight: 300;
            letter-spacing: .125rem;
            pointer-events: none;
            transition: all .4s cubic-bezier(.4, .25, .8, .3) .05s;
        }

        .nav-dot {
            cursor: pointer;
            position: fixed;
            padding: .625rem 1.25rem .625rem .625rem;
            top: 52%;
            right: 1.25rem;
        &:before {
             content: '';
             display: inline-block;
             border-radius: 50%;
             width: .375rem;
             height: .375rem;
             margin-right: .625rem;
             position: fixed;
             background-color: lighten($background, 3%);
             border: 0;
             transition: all 0.25s;
         }
        &:hover:before {
             width: .625rem;
             height: .625rem;
             margin-top: -.125rem;
             margin-left: -.125rem;
             background-color: darken($primary, 5%);
         }
        }



        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            background-image: linear-gradient(to bottom right, $background 0%, $dark 100%);
            font-family: 'Lato', sans-serif;
        }

        form {
            width: 100%;
            height: 100%;
            overflow: hidden;
        }
    </style>
</head>
<form>
    <input id="input-1" type="text" placeholder="John Doe" required autofocus />
    <label for="input-1">
        <span class="label-text">Full Name</span>
        <span class="nav-dot"></span>
        <div class="signup-button-trigger">Sign Up</div>
    </label>
    <input id="input-2" type="text" placeholder="john" required />
    <label for="input-2">
        <span class="label-text">Username</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-3" type="email" placeholder="email@address.com" required />
    <label for="input-3">
        <span class="label-text">Email</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-4" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
    <label for="input-4">
        <span class="label-text">Password</span>
        <span class="nav-dot"></span>
    </label>
    <input id="input-5" type="text" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;" required />
    <label for="input-5">
        <span class="label-text">Confirm Password</span>
        <span class="nav-dot"></span>
    </label>
    <button type="submit">Create Your Account</button>
    <p class="tip">Press Tab</p>
    <div class="signup-button">Sign Up</div>
</form>
