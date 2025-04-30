# Contact Management System

## API Documentation

### Base URL

```
/api
```

### Available Endpoints

#### List All Contacts

-   **GET** `/contacts`
-   **Query Parameters:**
    -   `page`: Page number (default: 1)
    -   `per_page`: Items per page (default: 10)
    -   `sort_by`: Field to sort by (name, email, purpose, created_at)
    -   `sort_direction`: Sort direction (asc, desc)
    -   `search`: Search term for name, email, or message
    -   `purpose`: Filter by purpose
-   **Response:**
    ```json
    {
      "data": [...],
      "links": {
        "first": "http://...",
        "last": "http://...",
        "prev": null,
        "next": "http://..."
      },
      "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 5,
        "path": "http://...",
        "per_page": 10,
        "to": 10,
        "total": 50
      }
    }
    ```

#### Create New Contact

-   **POST** `/contacts`
-   **Body:**
    ```json
    {
        "name": "John Doe",
        "email": "john@example.com",
        "mobile": "1234567890",
        "purpose": "general",
        "message": "Sample message"
    }
    ```
-   **Validation:**
    -   name: Required, min 3 chars, max 255 chars
    -   email: Required, valid email
    -   mobile: Required, 10 digits
    -   purpose: Required, one of: general, support, feedback, business, other
    -   message: Required, min 10 chars

#### Get Contact Details

-   **GET** `/contacts/{id}`
-   **Response:** Single contact object

#### Update Contact

-   **PUT** `/contacts/{id}`
-   **Body:** Same as create contact

#### Delete Contact

-   **DELETE** `/contacts/{id}`
-   **Response:** 204 No Content

#### Get Purpose Options

-   **GET** `/contacts/purpose-options`
-   **Response:**
    ```json
    {
        "general": "General Inquiry",
        "support": "Technical Support",
        "feedback": "Feedback",
        "business": "Business Opportunity",
        "other": "Other"
    }
    ```

#### Get Contact Statistics

-   **GET** `/contacts/stats`
-   **Response:**
    ```json
    {
        "total": 50,
        "by_purpose": {
            "general": {
                "count": 20,
                "label": "General Inquiry"
            },
            "support": {
                "count": 15,
                "label": "Technical Support"
            }
            // ...other purposes
        },
        "recent": [
            {
                "id": 1,
                "name": "John Doe",
                "created_at": "2025-04-30T..."
            }
            // ...more recent contacts
        ]
    }
    ```

### File Attachment Endpoints

#### Upload Attachment

-   **POST** `/contacts/{contact_id}/attachments`
-   **Content-Type:** multipart/form-data
-   **Body:**
    -   file: File upload (Required)
-   **Supported Files:** PDF, DOC, DOCX, JPG, JPEG, PNG
-   **Max Size:** 10MB
-   **Response:**
    ```json
    {
        "data": {
            "id": 1,
            "filename": "document.pdf",
            "mime_type": "application/pdf",
            "size": 1024000,
            "url": "http://example.com/storage/attachments/uuid.pdf",
            "created_at": "2025-04-30T..."
        }
    }
    ```

#### Download Attachment

-   **GET** `/contacts/{contact_id}/attachments/{attachment_id}/download`
-   **Response:** File download with original filename

#### Delete Attachment

-   **DELETE** `/contacts/{contact_id}/attachments/{attachment_id}`
-   **Response:** 204 No Content

## Application Features

### Current Features

1. Contact Management

    - Create, read, update, delete contacts
    - Form validation
    - Purpose selection dropdown
    - Mobile number validation
    - Success messages
    - Error handling

2. RESTful API
    - Full CRUD operations
    - Purpose options endpoint
    - Validation
    - JSON responses with proper status codes
    - Pagination support
    - Sorting by multiple fields
    - Search functionality
    - Purpose-based filtering
    - Contact statistics
    - File upload and download endpoints
    - Attachment management
    - Secure file handling

### Roadmap

#### Phase 1: Enhanced Contact Management

-   [x] Add pagination for contacts list
-   [x] Add sorting and filtering options
-   [x] Implement search functionality
-   [x] Add file attachments support
-   [ ] Add contact categories

#### Phase 2: User Management

-   [ ] User authentication
-   [ ] User roles and permissions
-   [ ] Contact assignment to users
-   [ ] User activity logging

#### Phase 3: Communication Features

-   [ ] Email notifications
-   [ ] SMS notifications
-   [ ] Contact history tracking
-   [ ] Message templates
-   [ ] Bulk operations

#### Phase 4: Analytics and Reporting

-   [ ] Contact statistics dashboard
-   [ ] Custom report generation
-   [ ] Export data (CSV, Excel)
-   [ ] Analytics charts and graphs

#### Phase 5: Integration and Enhancement

-   [ ] Third-party CRM integration
-   [ ] Calendar integration
-   [ ] API rate limiting
-   [ ] API authentication
-   [ ] Swagger/OpenAPI documentation

## Contributing

Please read our contributing guidelines before submitting pull requests.

## License

This project is licensed under the MIT License - see the LICENSE file for details.
