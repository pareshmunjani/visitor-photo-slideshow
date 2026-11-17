
## Additional implementation assumptions

### Email normalization
Email addresses are trimmed and converted to lowercase before database lookup.
This helps identify returning visitors consistently.

### Returning visitor name
If an existing visitor submits a different name using the same email,
the existing visitor record is updated with the latest name.
This allows visitors to correct their names without creating duplicate records.

### Upload consistency
All files are validated before being moved into permanent storage.
Database changes are performed in a transaction.
If database processing fails, moved files are removed as part of failure cleanup.
