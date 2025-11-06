<!DOCTYPE html>
<html lang="en">
<body style="font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Arial, sans-serif; padding:16px;">
  <h2>New Lead Notification</h2>
  <p>A new lead was submitted.</p>
  <ul>
    <li><strong>Name:</strong> {{ $lead->name }}</li>
    <li><strong>Email:</strong> {{ $lead->email }}</li>
    <li><strong>Phone:</strong> {{ $lead->phone ?? '-' }}</li>
    <li><strong>Company:</strong> {{ $lead->company ?? '-' }}</li>
    <li><strong>Locale:</strong> {{ $lead->locale }}</li>
    <li><strong>Business Type:</strong> {{ $lead->business_type ?? '-' }}</li>
    <li><strong>Needs:</strong>
      website={{ $lead->need_website ? 'yes':'no' }},
      content={{ $lead->need_content ? 'yes':'no' }},
      ai={{ $lead->need_ai ? 'yes':'no' }},
      seo={{ $lead->need_seo ? 'yes':'no' }}
    </li>
    <li><strong>Budget Range:</strong> {{ $lead->budget_range ?? '-' }}</li>
    <li><strong>Package ID:</strong> {{ $lead->package_id ?? '-' }}</li>
    <li><strong>Price Estimate:</strong> {{ $lead->price_estimate_min }} – {{ $lead->price_estimate_max }} {{ $lead->currency }}</li>
    <li><strong>Notes:</strong> {{ $lead->notes ?? '-' }}</li>
    <li><strong>Source:</strong> {{ $lead->source ?? 'site' }}</li>
    <li><strong>Stage:</strong> {{ $lead->stage ?? 'new' }}</li>
  </ul>
  <p style="color:#888">This email was generated automatically.</p>
</body>
</html>
