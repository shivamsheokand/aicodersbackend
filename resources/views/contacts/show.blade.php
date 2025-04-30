<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Contact</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-lg mx-auto">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-800">Contact Details</h1>
                <a href="{{ route('contacts.index') }}" class="text-blue-500 hover:text-blue-600">Back to List</a>
            </div>

            <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                    <p class="text-gray-900">{{ $contact->name }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                    <p class="text-gray-900">{{ $contact->email }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Mobile Number</label>
                    <p class="text-gray-900">{{ $contact->mobile }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Purpose</label>
                    <p class="text-gray-900">{{ $contact->purpose }}</p>
                </div>

                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2">Message</label>
                    <p class="text-gray-900 whitespace-pre-line">{{ $contact->message }}</p>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('contacts.edit', $contact) }}" 
                       class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Edit Contact
                    </a>
                    <form action="{{ route('contacts.destroy', $contact) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" 
                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline"
                                onclick="return confirm('Are you sure you want to delete this contact?')">
                            Delete Contact
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
