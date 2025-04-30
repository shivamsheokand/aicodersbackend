<div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 8px; background-color: #f9f9f9;">
    <form method="POST" action="{{ route('contacts.create') }}" style="display: flex; flex-direction: column; gap: 15px;">
        @csrf
        <div style="display: flex; flex-direction: column;">
            <label for="name" style="margin-bottom: 5px; font-weight: bold;">Name:</label>
            <input type="text" id="name" name="name" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="display: flex; flex-direction: column;">
            <label for="email" style="margin-bottom: 5px; font-weight: bold;">Email:</label>
            <input type="email" id="email" name="email" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="display: flex; flex-direction: column;">
            <label for="mobile" style="margin-bottom: 5px; font-weight: bold;">Mobile No:</label>
            <input type="text" id="mobile" name="mobile" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="display: flex; flex-direction: column;">
            <label for="purpose" style="margin-bottom: 5px; font-weight: bold;">Purpose:</label>
            <input type="text" id="purpose" name="purpose" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        </div>
        <div style="display: flex; flex-direction: column;">
            <label for="message" style="margin-bottom: 5px; font-weight: bold;">Message:</label>
            <textarea id="message" name="message" rows="4" required style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
        </div>
        <div>
            <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">Submit</button>
        </div>
    </form>
</div>
