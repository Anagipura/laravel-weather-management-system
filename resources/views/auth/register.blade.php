<x-guest-layout>
    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label>Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" required>
                    @error('password')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" required>
                    @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-options">
                    <a href="{{ route('login') }}">Already registered?</a>
                </div>

                <button type="submit" class="btn-login">Register</button>
            </form>
        </div>
    </div>
    <style>
        /* Background container */
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea, #764ba2);
        }

        /* Card */
        .login-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.1);
            animation: fadeIn 0.4s ease;
        }

        /* Title */
        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #1a1a2e;
        }

        /* Form groups */
        .form-group {
            margin-bottom: 16px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        /* Inputs */
        .form-group input {
            width: 100%;
            padding: 11px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .form-group input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.2);
        }

        /* Links / options */
        .form-options {
            display: flex;
            justify-content: flex-end;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .form-options a {
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .form-options a:hover {
            text-decoration: underline;
        }

        /* Button */
        .btn-login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #ffffff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }

        /* Error messages */
        .error {
            display: block;
            margin-top: 5px;
            color: #dc3545;
            font-size: 12px;
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</x-guest-layout>
