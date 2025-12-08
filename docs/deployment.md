# Deployment Checklist

## Required Secrets / Environment Variables

Configure these variables in your deployment environment (e.g. GitHub Actions, Forge, Vapor) before promoting builds:

| Variable | Purpose |
| --- | --- |
| `APP_KEY` | Laravel application key (generate via `php artisan key:generate`). |
| `CRM_API_ENDPOINT` | Base URL of the CRM API used by `HttpCrmClient` (e.g. `https://crm.example.com/api`). |
| `CRM_API_TOKEN` | Bearer token injected into outbound CRM requests. |
| `CRM_API_TIMEOUT` | Optional request timeout (seconds) for CRM syncs. |
| `LEAD_ALERT_RECIPIENTS` | Comma-separated list of inbox addresses for lead notifications. |
| `CONTACT_ALERT_RECIPIENTS` | Comma-separated list of inbox addresses for contact notifications. |

> Make sure secrets are scoped to the deployment target and rotated regularly.

## Queue & Scheduler

- Ensure the queue worker is running (listeners dispatch queued mailables/jobs).
- Schedule a horizon/queue monitor if high throughput is expected.

## Post-Deployment Validation

1. Trigger a lead/quote submission in staging and confirm notification emails are delivered.
2. Log a contact form submission and verify CRM sync executes (inspect logs or CRM dashboard).
3. Load the public site and ensure visit records appear in the `visits` table.
