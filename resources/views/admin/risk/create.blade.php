<x-app-layout>

    <div class="form-container">

        <h2>Create Risk Level</h2>

        <form method="POST" action="{{ route('admin.risk.store') }}" class="risk-form">
            @csrf

            <!-- Country -->
            <div class="form-group">
                <label>Country Code</label>
                <input type="text" name="country" placeholder="e.g. LK" required>
            </div>

            <!-- Risk Level -->
            <div class="form-group">
                <label>Risk Level</label>
                <select name="risklevel" required>
                    <option value="">Select Risk Level</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>

            <!-- Description -->
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" placeholder="Enter description..." rows="4"></textarea>
            </div>

            <!-- Submit -->
            <button type="submit" class="btn-submit">
                Create Risk Level
            </button>
        </form>

    </div>

    <style>

        .form-container {
            max-width: 500px;
            margin: 40px auto;
            padding: 30px;
            border-radius: 20px;
            background: var(--card-bg);
            box-shadow: var(--card-shadow);
            border: 1px solid var(--card-border);
        }

        /* Title */
        .form-container h2 {
            text-align: center;
            margin-bottom: 25px;
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Form */
        .risk-form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        /* Inputs */
        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 6px;
            font-weight: 500;
            color: var(--text-secondary);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            padding: 10px 12px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
            background: var(--glass-bg);
            outline: none;
            transition: var(--transition-normal);
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.4);
        }

        /* Button */
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
