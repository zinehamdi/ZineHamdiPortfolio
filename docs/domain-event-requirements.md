# Domain Event Requirements

This document captures the outstanding requirements needed to design listeners for the remaining domain events that currently have no downstream consumers.

## VisitLogged (App\\Domain\\Marketing\\Events\\VisitLogged)

**Trigger**: Dispatched by `VisitObserver` whenever a `Visit` record is created (middleware `App\Http\Middleware\LogVisit`).

**Payload**: `Visit` model with IP, user agent, path, locale, and referrer.

**Current usage**: No listeners registered. Visit counts power the admin dashboard via `VisitRepository::count()` and cached metrics (`admin.dashboard.*` keys).

**Requirements to confirm**:
- Should the event update or bust existing dashboard caches (e.g. `admin.dashboard.metrics`, `admin.dashboard.leads_by_stage`)?
- Do we need a rolling aggregation (daily/weekly) persisted for analytics views?
- Should the event forward data to an external analytics provider (e.g. Plausible, GA) or internal data warehouse?
- Are there privacy constraints (IP masking, consent) that must be applied before emitting downstream?

**Open questions**:
- Retention policy for raw visits vs aggregated metrics.
- Threshold for throttling/high-volume traffic to avoid queue overload.

## AdminMessageCreated (App\\Domain\\Shared\\Events\\AdminMessageCreated)

**Trigger**: Dispatched by `AdminMessageObserver` whenever an admin message is stored (`AdminMessageService::create`).

**Payload**: `AdminMessage` model with subject, body, from name/email.

**Current usage**: No listeners registered. Admin messages appear in the internal inbox UI.

**Requirements to confirm**:
- Should creation notify administrators via email or Slack? If so, which distribution list or webhook URL?
- Do messages require acknowledgement or read-status updates that should be triggered asynchronously?
- Should the event feed an audit log or real-time broadcast (e.g. Livewire events/Pusher) for active admin sessions?
- Are spam or security scans required before notifying downstream systems?

**Open questions**:
- SLA/priority expectations for admin notifications (do we need retry/backoff rules?).
- Should certain message categories be routed differently (support vs alerts)?

---

Once the above requirements are clarified, listeners can be designed following the established convention (`app/Domain/*/Listeners`) with event-to-listener mappings defined in `App\Providers\EventServiceProvider`.
