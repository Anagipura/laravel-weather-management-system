<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="login-container">
        <div class="login-card">
            <h2 class="login-title">Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

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

                <div class="form-options">
                    <label>
                        <input type="checkbox" name="remember"> Remember me
                    </label>

                    <a href="{{ route('password.request') }}">Forgot password?</a>
                </div>

                <button type="submit" class="btn-login">Log in</button>
            </form>
        </div>
    </div>

    <style>
        /* Container */
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
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        /* Title */
        .login-title {
            text-align: center;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 25px;
            color: #333;
        }

        /* Form */
        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            margin-bottom: 6px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 10px 12px;
            border-radius: 8px;
            border: 1px solid #ddd;
            transition: 0.2s;
        }

        .form-group input:focus {
            border-color: #667eea;
            outline: none;
            box-shadow: 0 0 0 3px rgba(102,126,234,0.2);
        }

        /* Options */
        .form-options {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .form-options a {
            color: #667eea;
            text-decoration: none;
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
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn-login:hover {
            transform: translateY(-1px);
            box-shadow: 0 8px 20px rgba(102,126,234,0.3);
        }

        /* Error */
        .error {
            color: #dc3545;
            font-size: 12px;
        }
    </style>

</x-guest-layout>
