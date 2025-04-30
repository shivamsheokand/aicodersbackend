<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Create Contact</h1>
                <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:text-blue-600">Back to List</a>
            </div>

            @if($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('contacts.store') }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('name') border-red-500 @enderror"
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror"
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="mobile">
                        Mobile Number
                    </label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('mobile') border-red-500 @enderror"
                        type="text" 
                        id="mobile" 
                        name="mobile" 
                        value="{{ old('mobile') }}"
                        required>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="purpose">
                        Purpose
                    </label>
                    <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('purpose') border-red-500 @enderror"
                        id="purpose" 
                        name="purpose" 
                        required>
                        <option value="">Select a purpose</option>
                        <option value="general" {{ old('purpose') == 'general' ? 'selected' : '' }}>General Inquiry</option>
                        <option value="support" {{ old('purpose') == 'support' ? 'selected' : '' }}>Technical Support</option>
                        <option value="feedback" {{ old('purpose') == 'feedback' ? 'selected' : '' }}>Feedback</option>
                        <option value="business" {{ old('purpose') == 'business' ? 'selected' : '' }}>Business Opportunity</option>
                        <option value="other" {{ old('purpose') == 'other' ? 'selected' : '' }}>Other</option>
                    </select>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
                        Message
                    </label>
                    <textarea 
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline @error('message') border-red-500 @enderror"
                        id="message" 
                        name="message" 
                        rows="4"
                        required>{{ old('message') }}</textarea>
                </div>

                <div class="flex items-center justify-between">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit">
                        Create Contact
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
