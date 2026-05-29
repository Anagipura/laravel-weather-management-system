<x-app-layout>
    <div class="formContainer">
        <h2>Create Alert</h2>

        <form method="POST" action="{{ route('admin.alerts.store')}}" class="alert-form">
            @csrf
            <div class="input-container">
                <label>Alert Title : </label>
                <input type="text" name="title" placeholder="Title" required>
            </div>

            <div class="input-container">
                <label>Alert description : </label>
                <textarea name="message" placeholder="Message" required></textarea>
            </div>

            <div class="input-container">
                <label>Alert Type : </label>
                <select name="type" required>
                    <option value="" selected>Select Alert type</option>
                    <option value="critical">Critical</option>
                    <option value="warning">Warning</option>
                    <option value="info">Info</option>
                </select>
            </div>

            <div class="input-container">
                <label>Effected Country : </label>
                <select name="location" required>
                    <option value="" selected>Select country</option>
                    <option value="LK">Sri Lanka</option>
                    <option value="IND">India</option>
                    <option value="MV">Maldives</option>
                </select>
            </div>

            <div class="input-container">
                <label>Severity of the Alert : </label>
                <select name="severity" required>
                    <option value="" selected>Select severity</option>
                    <option value="High">High</option>
                    <option value="medium">Medium</option>
                    <option value="low">Low</option>
                </select>
            </div>

            <button type="submit" class="btn-submit">Save</button>
        </form>
    </div>

    <style>
        .alert-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .input-container {
            display: flex;
            flex-direction: column;
        }
        .input-container label {
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .input-container input,
        .input-container select,
        .input-container textarea {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            outline: none;
            transition: var(--transition-normal);
        }
        .input-container input:focus,
        .input-container select:focus,
        .input-container textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.4);
        }

        .formContainer {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 20px;
            background: var(--card-bg);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--card-border);
        }

        h2 {
            text-align: center;
            margin-bottom: 25px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .btn-submit {
            padding: 12px;
            border: none;
            border-radius: 12px;
            background: var(--primary-gradient);
            color: white;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition-normal);
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(102, 126, 234, 0.3);
        }
    </style>

</x-app-layout>
