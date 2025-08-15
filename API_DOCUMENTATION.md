# Leads API Documentation

## Base URL
```
http://your-domain.com/api
```

## Authentication
All endpoints require authentication using Laravel Sanctum. Include the Bearer token in the Authorization header:
```
Authorization: Bearer {your-token}
```

## Endpoints

### 1. Get All Leads
**GET** `/leads`

**Description:** Retrieve leads based on user role
- **Admin:** Gets all leads in the system
- **Agent:** Gets only leads assigned to them

**Query Parameters:**
- `sort_by` (optional): Field to sort by (`name`, `email`, `phone`, `status`, `assigned_to`, `created_at`)
- `sort_direction` (optional): Sort direction (`asc`, `desc`)
- `page` (optional): Page number for pagination

**Example Request:**
```bash
curl -X GET "http://your-domain.com/api/leads?sort_by=name&sort_direction=asc&page=1" \
  -H "Authorization: Bearer {your-token}"
```

**Response (Admin):**
```json
{
  "success": true,
  "message": "Leads retrieved successfully",
  "data": {
    "leads": [
      {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "1234567890",
        "status": "new",
        "assigned_to": {
          "id": 2,
          "name": "Agent Smith"
        },
        "notes": "Interested in our services",
        "created_at": "2024-01-15 10:30:00",
        "updated_at": "2024-01-15 10:30:00"
      }
    ],
    "pagination": {
      "current_page": 1,
      "last_page": 5,
      "per_page": 10,
      "total": 50,
      "from": 1,
      "to": 10
    },
    "user_role": "admin",
    "filters_applied": {
      "role_based_filtering": "all_leads",
      "sort_by": "name",
      "sort_direction": "asc"
    }
  }
}
```

**Response (Agent):**
```json
{
  "success": true,
  "message": "Leads retrieved successfully",
  "data": {
    "leads": [
      {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "phone": "1234567890",
        "status": "new",
        "assigned_to": null,
        "notes": "Interested in our services",
        "created_at": "2024-01-15 10:30:00",
        "updated_at": "2024-01-15 10:30:00"
      }
    ],
    "pagination": {
      "current_page": 1,
      "last_page": 2,
      "per_page": 10,
      "total": 15,
      "from": 1,
      "to": 10
    },
    "user_role": "agent",
    "filters_applied": {
      "role_based_filtering": "assigned_leads_only",
      "sort_by": "name",
      "sort_direction": "asc"
    }
  }
}
```

### 2. Create Lead
**POST** `/leads`

**Description:** Create a new lead (Admin only)

**Request Body:**
```json
{
  "name": "Jane Smith",
  "email": "jane@example.com",
  "phone": "0987654321",
  "status": "new",
  "assigned_to": 2,
  "notes": "New potential customer"
}
```

**Example Request:**
```bash
curl -X POST "http://your-domain.com/api/leads" \
  -H "Authorization: Bearer {your-token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "Jane Smith",
    "email": "jane@example.com",
    "phone": "0987654321",
    "status": "new",
    "assigned_to": 2,
    "notes": "New potential customer"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Lead created successfully",
  "data": {
    "lead": {
      "id": 2,
      "name": "Jane Smith",
      "email": "jane@example.com",
      "phone": "0987654321",
      "status": "new",
      "assigned_to": 2,
      "notes": "New potential customer",
      "created_at": "2024-01-15 11:00:00"
    }
  }
}
```

### 3. Get Single Lead
**GET** `/leads/{id}`

**Description:** Retrieve a specific lead
- **Admin:** Can view any lead
- **Agent:** Can only view leads assigned to them

**Example Request:**
```bash
curl -X GET "http://your-domain.com/api/leads/1" \
  -H "Authorization: Bearer {your-token}"
```

**Response:**
```json
{
  "success": true,
  "message": "Lead retrieved successfully",
  "data": {
    "lead": {
      "id": 1,
      "name": "John Doe",
      "email": "john@example.com",
      "phone": "1234567890",
      "status": "new",
      "assigned_to": {
        "id": 2,
        "name": "Agent Smith"
      },
      "notes": "Interested in our services",
      "created_at": "2024-01-15 10:30:00",
      "updated_at": "2024-01-15 10:30:00"
    }
  }
}
```

### 4. Update Lead
**PUT** `/leads/{id}`

**Description:** Update a lead
- **Admin:** Can update any lead and change assignment
- **Agent:** Can only update leads assigned to them (cannot change assignment)

**Request Body:**
```json
{
  "name": "John Doe Updated",
  "email": "john.updated@example.com",
  "phone": "1234567890",
  "status": "contacted",
  "assigned_to": 3,
  "notes": "Contacted customer, interested in premium plan"
}
```

**Example Request:**
```bash
curl -X PUT "http://your-domain.com/api/leads/1" \
  -H "Authorization: Bearer {your-token}" \
  -H "Content-Type: application/json" \
  -d '{
    "name": "John Doe Updated",
    "email": "john.updated@example.com",
    "phone": "1234567890",
    "status": "contacted",
    "assigned_to": 3,
    "notes": "Contacted customer, interested in premium plan"
  }'
```

**Response:**
```json
{
  "success": true,
  "message": "Lead updated successfully",
  "data": {
    "lead": {
      "id": 1,
      "name": "John Doe Updated",
      "email": "john.updated@example.com",
      "phone": "1234567890",
      "status": "contacted",
      "assigned_to": {
        "id": 3,
        "name": "Agent Johnson"
      },
      "notes": "Contacted customer, interested in premium plan",
      "updated_at": "2024-01-15 12:00:00"
    }
  }
}
```

### 5. Delete Lead
**DELETE** `/leads/{id}`

**Description:** Delete a lead (Admin only)

**Example Request:**
```bash
curl -X DELETE "http://your-domain.com/api/leads/1" \
  -H "Authorization: Bearer {your-token}"
```

**Response:**
```json
{
  "success": true,
  "message": "Lead deleted successfully",
  "data": null
}
```

## Error Responses

### 403 Forbidden
```json
{
  "success": false,
  "message": "Access denied. Only administrators can create leads.",
  "data": null
}
```

### 404 Not Found
```json
{
  "success": false,
  "message": "Lead not found",
  "data": null
}
```

### 422 Validation Error
```json
{
  "success": false,
  "message": "Validation failed",
  "data": {
    "email": ["The email field is required."],
    "name": ["The name field is required."]
  }
}
```

### 500 Server Error
```json
{
  "success": false,
  "message": "Failed to retrieve leads: Database connection error",
  "data": null
}
```

## Role-Based Access Control

### Admin Role
- ✅ View all leads
- ✅ Create new leads
- ✅ Edit any lead
- ✅ Delete any lead
- ✅ Assign leads to agents
- ✅ See assignment information

### Agent Role
- ✅ View only assigned leads
- ❌ Create new leads
- ✅ Edit only assigned leads
- ❌ Delete any leads
- ❌ Change lead assignments
- ❌ See assignment information

## Status Values
- `new` - New lead
- `contacted` - Lead has been contacted
- `closed` - Lead is closed

## Notes
- All timestamps are in `Y-m-d H:i:s` format
- Pagination is set to 10 items per page by default
- Sorting is available on all list endpoints
- Role-based filtering is applied automatically



