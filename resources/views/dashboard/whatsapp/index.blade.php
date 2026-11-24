@extends('layout.index')

@section('title', 'WhatsApp')

@section('breadcumb')
    <div class="page-header">
        <h1 class="my-auto page-title">WhatsApp Business</h1>
        <div>
            <ol class="mb-0 breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">WhatsApp</li>
            </ol>
        </div>
    </div>
@endsection

@section('content')
    <style>
        .wa-endpoint { font: 12px ui-monospace, Consolas, monospace; color: #6c757d; margin-bottom: .75rem; }
        .wa-perm { font: 600 12px ui-monospace, Consolas, monospace; }
        .wa-log { background: #1c1e21; color: #e4e6eb; border-radius: .5rem; padding: 1rem; font: 12px/1.6 ui-monospace, Consolas, monospace; max-height: 360px; overflow: auto; white-space: pre-wrap; word-break: break-word; }
        .wa-log .req { color: #8ab4f8; }
        .wa-log .ok { color: #81c995; }
        .wa-log .err { color: #f28b82; }
        .wa-ids code { color: inherit; }
        .wa-preview { background: #e7fbe9; border: 1px solid #c9eccd; border-radius: .5rem; padding: .75rem 1rem; white-space: pre-wrap; max-width: 520px; }
        .wa-preview .wa-preview-header { font-weight: 600; margin-bottom: .35rem; }
        .wa-preview .wa-preview-footer { color: #6c757d; font-size: 12px; margin-top: .35rem; }
        .wa-preview mark { background: #fff3cd; padding: 0 .15rem; }
    </style>

    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header justify-content-between flex-wrap gap-2">
                    <div class="card-title">WhatsApp Cloud API</div>
                    <div class="wa-ids small text-muted">
                        Business ID <code>{{ $config['business_id'] ?: '-' }}</code> ·
                        WABA ID <code>{{ $config['waba_id'] ?: '-' }}</code> ·
                        Phone number ID <code>{{ $config['phone_number_id'] ?: '-' }}</code>
                    </div>
                </div>
                <div class="card-body">
                    @unless ($ready)
                        <div class="alert alert-warning">Set <code>WA_ACCESS_TOKEN</code> in <code>.env</code> to use this page.</div>
                    @endunless

                    <ul class="nav nav-tabs mb-3" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="tab-assets" data-bs-toggle="tab" data-bs-target="#pane-assets" type="button" role="tab">1 · Business assets</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-manage" data-bs-toggle="tab" data-bs-target="#pane-manage" type="button" role="tab">2 · Phone numbers &amp; templates</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-send" data-bs-toggle="tab" data-bs-target="#pane-send" type="button" role="tab">3 · Send message</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="tab-connect" data-bs-toggle="tab" data-bs-target="#pane-connect" type="button" role="tab">4 · Connect WhatsApp Business app</button>
                        </li>
                    </ul>

                    <div class="tab-content">
                        {{-- business_management --}}
                        <div class="tab-pane fade show active" id="pane-assets" role="tabpanel">
                            <h5>Business assets <span class="badge bg-primary-transparent wa-perm">business_management</span></h5>
                            <p class="text-muted mb-1">The WhatsApp Business Accounts owned by our business portfolio.</p>
                            <p class="wa-endpoint">GET /{business-id}/owned_whatsapp_business_accounts</p>
                            <button class="btn btn-primary" type="button" data-load="business-assets">Load WhatsApp Business Accounts</button>
                            <div class="table-responsive mt-3" hidden data-table="business-assets">
                                <table class="table table-bordered text-nowrap">
                                    <thead><tr><th>WABA ID</th><th>Name</th><th>Currency</th><th>Timezone</th><th>Template namespace</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>

                        {{-- whatsapp_business_management --}}
                        <div class="tab-pane fade" id="pane-manage" role="tabpanel">
                            <h5>Phone numbers <span class="badge bg-primary-transparent wa-perm">whatsapp_business_management</span></h5>
                            <p class="wa-endpoint">GET /{waba-id}/phone_numbers</p>
                            <button class="btn btn-primary" type="button" data-load="phone-numbers">Load phone numbers</button>
                            <div class="table-responsive mt-3" hidden data-table="phone-numbers">
                                <table class="table table-bordered text-nowrap">
                                    <thead><tr><th>Phone number</th><th>Display name</th><th>Phone number ID</th><th>Platform</th><th>Quality</th><th>Status</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <hr class="my-4">
                            <h5>Message templates <span class="badge bg-primary-transparent wa-perm">whatsapp_business_management</span></h5>
                            <p class="wa-endpoint">GET /{waba-id}/message_templates · POST /{waba-id}/message_templates</p>
                            <button class="btn btn-primary" type="button" data-load="templates">Load templates</button>
                            <div class="table-responsive mt-3" hidden data-table="templates">
                                <table class="table table-bordered text-nowrap">
                                    <thead><tr><th>Name</th><th>Category</th><th>Language</th><th>Status</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <h6 class="mt-4">Create a template</h6>
                            <form data-form="templates" data-url="{{ route('whatsapp.templates.store') }}">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label" for="t-name">Template name</label>
                                        <input class="form-control" id="t-name" name="name" value="task_completed_notice" required>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="t-lang">Language</label>
                                        <select class="form-select" id="t-lang" name="language">
                                            <option value="id">Indonesian (id)</option>
                                            <option value="en_US">English (en_US)</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label" for="t-example">Example for @{{1}}</label>
                                        <input class="form-control" id="t-example" name="example" value="Budi">
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label" for="t-body">Body (category: UTILITY)</label>
                                        <textarea class="form-control" id="t-body" name="body" rows="3">Halo @{{1}}, tugas Anda di Di-kerjain sudah selesai dikerjakan. Silakan cek hasilnya di aplikasi.</textarea>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3" type="submit">Submit template for review</button>
                                <div class="alert mt-3" hidden data-result></div>
                            </form>
                        </div>

                        {{-- whatsapp_business_messaging --}}
                        <div class="tab-pane fade" id="pane-send" role="tabpanel">
                            <h5>Send a WhatsApp message <span class="badge bg-primary-transparent wa-perm">whatsapp_business_messaging</span></h5>
                            <p class="text-muted mb-1">Task updates to customers from our business number.</p>
                            <p class="wa-endpoint">POST /{phone-number-id}/messages</p>
                            <form data-form="messages" data-url="{{ route('whatsapp.messages.store') }}">
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label" for="m-to">Recipient WhatsApp number</label>
                                        <input class="form-control" id="m-to" name="to" placeholder="0812xxxxxxxx" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label" for="m-type">Message type</label>
                                        <select class="form-select" id="m-type" name="type">
                                            <option value="text">Text (customer messaged us in the last 24 h)</option>
                                            <option value="template">Approved template</option>
                                        </select>
                                    </div>
                                    <div class="col-12" data-when="text">
                                        <label class="form-label" for="m-text">Message</label>
                                        <textarea class="form-control" id="m-text" name="text" rows="3">Halo! Tugas Anda di Di-kerjain sudah kami terima dan sedang dikerjakan. Kami kabari lagi saat selesai.</textarea>
                                    </div>
                                    <div class="col-12" data-when="template" hidden>
                                        <label class="form-label" for="m-template">Template</label>
                                        <div class="d-flex gap-2">
                                            <select class="form-select" id="m-template">
                                                <option value="">Loading approved templates…</option>
                                            </select>
                                            <button class="btn btn-light text-nowrap" type="button" id="m-template-reload">Reload</button>
                                        </div>
                                    </div>
                                    <div class="col-12" data-when="template" hidden>
                                        <div class="row g-3" id="m-template-vars"></div>
                                        <label class="form-label mt-3 mb-1">Preview</label>
                                        <div class="wa-preview" id="m-template-preview">Choose a template.</div>
                                    </div>
                                </div>
                                <button class="btn btn-primary mt-3" type="submit">Send message</button>
                                <div class="alert mt-3" hidden data-result></div>
                            </form>
                        </div>

                        {{-- Embedded Signup, Coexistence --}}
                        <div class="tab-pane fade" id="pane-connect" role="tabpanel">
                            <h5>Connect a WhatsApp Business app number <span class="badge bg-primary-transparent wa-perm">Embedded Signup · Coexistence</span></h5>
                            <p class="text-muted mb-1">The number keeps working in the WhatsApp Business app and also works through the Cloud API.</p>
                            <p class="wa-endpoint">App ID {{ $config['app_id'] ?: '-' }} · Configuration ID {{ $config['es_config_id'] ?: '-' }} · App secret {{ filled($config['app_secret']) ? 'set' : 'missing' }}</p>
                            @unless ($signupReady)
                                <div class="alert alert-warning">Set <code>META_APP_ID</code>, <code>META_APP_SECRET</code> and <code>WA_ES_CONFIG_ID</code> in <code>.env</code> first.</div>
                            @endunless
                            <div class="d-flex flex-wrap align-items-center gap-2">
                                <button class="btn btn-success" type="button" id="es-launch" disabled>Connect WhatsApp Business app</button>
                                <span id="es-sdk" class="wa-endpoint mb-0">Loading Facebook SDK…</span>
                            </div>
                            <div class="alert mt-3" hidden id="es-result"></div>
                            <div class="table-responsive mt-3" hidden id="es-steps">
                                <table class="table table-bordered">
                                    <thead><tr><th>Step</th><th>HTTP</th><th>Result</th></tr></thead>
                                    <tbody></tbody>
                                </table>
                            </div>

                            <hr class="my-4">
                            <h5>Connected number</h5>
                            <div id="es-status"><p class="text-muted">No number connected yet.</p></div>
                            <div class="d-flex flex-wrap gap-2">
                                <button class="btn btn-light" type="button" id="es-refresh">Refresh status</button>
                                <button class="btn btn-primary" type="button" data-sync="smb_app_state_sync" disabled>1 · Sync contacts</button>
                                <button class="btn btn-primary" type="button" data-sync="history" disabled>2 · Sync chat history</button>
                            </div>
                            <p class="wa-endpoint mt-2">Each sync runs once, within 24 hours of connecting. The data arrives at the webhook.</p>
                            <div class="alert" hidden id="sync-result"></div>

                            <hr class="my-4">
                            <h5>Webhook</h5>
                            <p class="mb-1">Callback URL <code>{{ route('whatsapp.webhook.receive') }}</code> · Verify token <code>{{ $config['webhook_verify_token'] ?: '(set WA_WEBHOOK_VERIFY_TOKEN)' }}</code></p>
                            <p class="wa-endpoint">Fields: messages, account_update, history, smb_app_state_sync, smb_message_echoes</p>
                            <button class="btn btn-light" type="button" id="wh-refresh">Refresh log</button>
                            <div class="wa-log mt-3" id="wh-log">No events yet.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title">API request log</div>
                </div>
                <div class="card-body">
                    <p class="text-muted">Every call this page makes to the WhatsApp Cloud API (graph.facebook.com), with the response.</p>
                    <div class="wa-log" id="api-log">Ready.</div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @php
        $waRoutes = [
            'business-assets' => route('whatsapp.business-assets'),
            'phone-numbers' => route('whatsapp.phone-numbers'),
            'templates' => route('whatsapp.templates'),
            'status' => route('whatsapp.signup.status'),
            'exchange' => route('whatsapp.signup.exchange'),
            'sync' => route('whatsapp.signup.sync'),
            'events' => route('whatsapp.webhook-events'),
        ];
        $waSignup = [
            'appId' => $config['app_id'],
            'configId' => $config['es_config_id'],
            'version' => $config['graph_version'],
            'ready' => $signupReady,
        ];
    @endphp
    <script>
        (() => {
            const routes = @json($waRoutes);
            const es = @json($waSignup);
            const csrf = document.querySelector('meta[name="csrf-token"]')?.content;
            const logBox = document.getElementById('api-log');
            const escapeHtml = (value) => String(value ?? '').replace(/[&<>"']/g, (c) => ({ '&': '&amp;', '<': '&lt;', '>': '&gt;', '"': '&quot;', "'": '&#39;' }[c]));
            const badge = (value) => {
                if (!value) return '';
                const tone = ['APPROVED', 'CONNECTED', 'GREEN', 'OK'].includes(value) ? 'bg-success'
                    : ['PENDING', 'IN_APPEAL', 'YELLOW'].includes(value) ? 'bg-warning text-dark'
                    : ['REJECTED', 'RED', 'DISCONNECTED', 'BANNED'].includes(value) ? 'bg-danger' : 'bg-light text-dark';
                return `<span class="badge ${tone}">${escapeHtml(value)}</span>`;
            };
            const errorOf = (data) => data.error?.message || data.body?.error?.error_user_msg || data.body?.error?.message || data.message || null;

            const log = (response) => {
                const ok = response.status >= 200 && response.status < 300;
                const request = response.request || {};
                const entry = `<span class="req">[${new Date().toLocaleTimeString()}] ${escapeHtml(request.method)} ${escapeHtml(request.url)}</span>\n`
                    + (request.body ? `${escapeHtml(JSON.stringify(request.body, null, 2))}\n` : '')
                    + `<span class="${ok ? 'ok' : 'err'}">→ HTTP ${escapeHtml(response.status)}</span>\n${escapeHtml(JSON.stringify(response.body, null, 2))}\n\n`;
                logBox.innerHTML = (logBox.textContent === 'Ready.' ? '' : logBox.innerHTML) + entry;
                logBox.scrollTop = logBox.scrollHeight;
            };

            const call = async (url, payload) => {
                const response = await fetch(url, {
                    method: payload ? 'POST' : 'GET',
                    credentials: 'same-origin',
                    headers: { 'Accept': 'application/json', 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf },
                    body: payload ? JSON.stringify(payload) : undefined,
                });
                let data;
                try { data = await response.json(); } catch { data = { message: `HTTP ${response.status}` }; }
                if (response.status === 401 || response.status === 419) data.message = 'Session expired. Reload the page and log in again.';
                if (data.request) log(data);
                return data;
            };

            const show = (box, ok, text) => {
                box.hidden = false;
                box.className = `alert mt-3 ${ok ? 'alert-success' : 'alert-danger'}`;
                box.textContent = text;
            };

            // ---- 1-2 · Lists ------------------------------------------------------------------
            const text = escapeHtml;
            const rows = {
                'business-assets': (item) => [text(item.id), text(item.name), text(item.currency), text(item.timezone_id), text(item.message_template_namespace)],
                'phone-numbers': (item) => [text(item.display_phone_number), text(item.verified_name), text(item.id), text(item.platform_type), badge(item.quality_rating), badge(item.status)],
                'templates': (item) => [text(item.name), text(item.category), text(item.language), badge(item.status)],
            };

            const load = async (name, button) => {
                if (button) button.disabled = true;
                try {
                    const data = await call(routes[name]);
                    const error = errorOf(data);
                    if (error) {
                        Swal.fire({ icon: 'error', title: 'Error', text: error });
                        return;
                    }
                    const wrap = document.querySelector(`[data-table="${name}"]`);
                    const items = data.body?.data || [];
                    wrap.querySelector('tbody').innerHTML = items.length
                        ? items.map((item) => `<tr>${rows[name](item).map((cell) => `<td>${cell}</td>`).join('')}</tr>`).join('')
                        : '<tr><td colspan="6" class="text-muted">No data.</td></tr>';
                    wrap.hidden = false;
                } catch (failure) {
                    Swal.fire({ icon: 'error', title: 'Error', text: failure.message });
                } finally {
                    if (button) button.disabled = false;
                }
            };
            document.querySelectorAll('[data-load]').forEach((button) => {
                button.addEventListener('click', () => load(button.dataset.load, button));
            });

            // ---- 3 · Approved templates for Send message ------------------------------------
            // Template variables are numbered (1, 2...) or named (customer_name), each
            // between double curly braces. No double brace is written literally below:
            // Blade would read it as an echo.
            const PLACEHOLDER = /\{\{\s*([A-Za-z0-9_]+)\s*\}\}/g;
            const curly = (key) => '{' + '{' + key + '}' + '}';
            const templateSelect = document.getElementById('m-template');
            const templateVars = document.getElementById('m-template-vars');
            const templatePreview = document.getElementById('m-template-preview');
            let approvedTemplates = [];
            let templatesLoaded = false;

            const partOf = (template, type) => (template?.components || []).find((component) => component.type === type);
            const keysIn = (value) => [...new Set([...String(value || '').matchAll(PLACEHOLDER)].map((match) => match[1]))];
            const selectedTemplate = () => approvedTemplates[templateSelect.value] ?? null;

            // Why a template cannot be sent from this page (media header, URL button with a variable).
            const unsupported = (template) => {
                const header = partOf(template, 'HEADER');
                if (header && header.format && header.format !== 'TEXT') return `Templates with a media header (${header.format.toLowerCase()}) cannot be sent from this page.`;
                const buttons = partOf(template, 'BUTTONS')?.buttons || [];
                if (buttons.some((button) => keysIn(button.url).length)) return 'Templates with a URL button variable cannot be sent from this page.';
                return null;
            };

            const exampleFor = (component, part, key) => {
                const example = component?.example || {};
                const named = example[`${part}_text_named_params`]?.find((item) => item.param_name === key)?.example;
                const positional = part === 'header' ? example.header_text?.[Number(key) - 1] : example.body_text?.[0]?.[Number(key) - 1];
                return named || positional || '';
            };

            const fill = (value, part) => escapeHtml(value || '').replace(PLACEHOLDER, (all, key) => {
                const input = templateVars.querySelector(`[data-var-part="${part}"][data-var-key="${key}"]`);
                const filled = input?.value.trim();
                return `<mark>${filled ? escapeHtml(filled) : curly(key)}</mark>`;
            });

            const renderPreview = () => {
                const template = selectedTemplate();
                if (!template) {
                    templatePreview.textContent = approvedTemplates.length ? 'Choose a template.' : 'No approved template yet. Create one in tab 2 and wait for APPROVED.';
                    return;
                }
                const header = partOf(template, 'HEADER');
                const footer = partOf(template, 'FOOTER');
                const buttons = partOf(template, 'BUTTONS')?.buttons || [];
                const problem = unsupported(template);
                templatePreview.innerHTML = (header?.format === 'TEXT' ? `<div class="wa-preview-header">${fill(header.text, 'header')}</div>` : '')
                    + `<div>${fill(partOf(template, 'BODY')?.text, 'body')}</div>`
                    + (footer?.text ? `<div class="wa-preview-footer">${escapeHtml(footer.text)}</div>` : '')
                    + (buttons.length ? `<div class="wa-preview-footer">Buttons: ${buttons.map((button) => escapeHtml(button.text)).join(' · ')}</div>` : '')
                    + (problem ? `<div class="text-danger mt-2">${escapeHtml(problem)}</div>` : '');
            };

            const renderTemplate = () => {
                const template = selectedTemplate();
                const header = partOf(template, 'HEADER');
                const body = partOf(template, 'BODY');
                const variables = [
                    ...(header?.format === 'TEXT' ? keysIn(header.text).map((key) => ({ part: 'header', key, component: header })) : []),
                    ...keysIn(body?.text).map((key) => ({ part: 'body', key, component: body })),
                ];
                templateVars.innerHTML = variables.map((variable) => `<div class="col-md-4">
                        <label class="form-label">${variable.part === 'header' ? 'Header ' : ''}${escapeHtml(curly(variable.key))}</label>
                        <input class="form-control" data-var-part="${variable.part}" data-var-key="${escapeHtml(variable.key)}" placeholder="${escapeHtml(exampleFor(variable.component, variable.part, variable.key))}">
                    </div>`).join('');
                renderPreview();
            };

            const loadApprovedTemplates = async () => {
                templateSelect.innerHTML = '<option value="">Loading approved templates…</option>';
                templateVars.innerHTML = '';
                try {
                    const data = await call(routes.templates);
                    const error = errorOf(data);
                    if (error) {
                        templateSelect.innerHTML = `<option value="">${escapeHtml(error)}</option>`;
                        return;
                    }
                    approvedTemplates = (data.body?.data || []).filter((template) => template.status === 'APPROVED');
                    templatesLoaded = true;
                    templateSelect.innerHTML = approvedTemplates.length
                        ? '<option value="">Choose a template…</option>' + approvedTemplates.map((template, index) =>
                            `<option value="${index}">${escapeHtml(template.name)} · ${escapeHtml(template.language)} · ${escapeHtml(template.category)}</option>`).join('')
                        : '<option value="">No approved template yet</option>';
                } catch (failure) {
                    templateSelect.innerHTML = `<option value="">${escapeHtml(failure.message)}</option>`;
                } finally {
                    renderPreview();
                }
            };

            templateSelect.addEventListener('change', renderTemplate);
            templateVars.addEventListener('input', renderPreview);
            document.getElementById('m-template-reload').addEventListener('click', () => loadApprovedTemplates());

            // ---- 2-3 · Forms ------------------------------------------------------------------
            const typeSelect = document.getElementById('m-type');
            typeSelect.addEventListener('change', () => {
                document.querySelectorAll('[data-when]').forEach((part) => { part.hidden = part.dataset.when !== typeSelect.value; });
                if (typeSelect.value === 'template' && !templatesLoaded) loadApprovedTemplates();
            });

            // The fields sent for a template message, or the reason it cannot be sent.
            const templateMessage = (form) => {
                const template = selectedTemplate();
                if (!template) return { error: 'Choose a template.' };
                const problem = unsupported(template);
                if (problem) return { error: problem };
                const values = (part) => [...templateVars.querySelectorAll(`[data-var-part="${part}"]`)]
                    .map((input) => ({ key: input.dataset.varKey, value: input.value.trim() }));
                const variables = [...values('header'), ...values('body')];
                if (variables.some((variable) => variable.value === '')) return { error: 'Fill in every template variable.' };
                return {
                    fields: {
                        to: form.elements.to.value,
                        type: 'template',
                        template: template.name,
                        language: template.language,
                        header_params: values('header'),
                        body_params: values('body'),
                    },
                };
            };

            document.querySelectorAll('[data-form]').forEach((form) => {
                form.addEventListener('submit', async (event) => {
                    event.preventDefault();
                    const result = form.querySelector('[data-result]');
                    const button = form.querySelector('button[type="submit"]');
                    let fields = Object.fromEntries(new FormData(form));
                    if (form.dataset.form === 'messages' && typeSelect.value === 'template') {
                        const message = templateMessage(form);
                        if (message.error) {
                            show(result, false, `Error: ${message.error}`);
                            return;
                        }
                        fields = message.fields;
                    }
                    button.disabled = true;
                    result.hidden = true;
                    try {
                        const data = await call(form.dataset.url, fields);
                        const error = errorOf(data);
                        if (error) {
                            show(result, false, `Error: ${error}`);
                            return;
                        }
                        if (form.dataset.form === 'messages') {
                            show(result, true, `Message accepted by WhatsApp. Message ID: ${data.body.messages?.[0]?.id ?? '-'}`);
                        } else {
                            show(result, true, `Template submitted. ID: ${data.body.id} · Status: ${data.body.status} · Category: ${data.body.category}`);
                            load('templates');
                        }
                    } catch (failure) {
                        show(result, false, `Error: ${failure.message}`);
                    } finally {
                        button.disabled = false;
                    }
                });
            });

            // ---- 4 · Embedded Signup, Coexistence ---------------------------------------------
            const launchButton = document.getElementById('es-launch');
            const sdkNote = document.getElementById('es-sdk');
            const esResult = document.getElementById('es-result');
            const syncResult = document.getElementById('sync-result');
            let session = {};

            // What the signup window reports (FINISH_WHATSAPP_BUSINESS_APP_ONBOARDING carries the WABA).
            window.addEventListener('message', (event) => {
                let host = '';
                try { host = new URL(event.origin).hostname; } catch { return; }
                if (host !== 'facebook.com' && !host.endsWith('.facebook.com')) return;
                let data;
                try { data = JSON.parse(event.data); } catch { return; }
                if (data?.type !== 'WA_EMBEDDED_SIGNUP') return;
                session = { event: data.event, ...(data.data || {}) };
                sdkNote.textContent = `Signup: ${data.event}`;
            });

            window.fbAsyncInit = () => {
                FB.init({ appId: es.appId, autoLogAppEvents: true, xfbml: false, version: es.version });
                sdkNote.textContent = es.ready ? 'Ready.' : 'Facebook SDK loaded; .env is incomplete.';
                launchButton.disabled = !es.ready;
            };
            if (es.appId) {
                const sdk = document.createElement('script');
                sdk.src = 'https://connect.facebook.net/en_US/sdk.js';
                sdk.async = true;
                sdk.defer = true;
                sdk.crossOrigin = 'anonymous';
                sdk.onerror = () => { sdkNote.textContent = 'Facebook SDK could not load.'; };
                document.head.append(sdk);
            } else {
                sdkNote.textContent = 'META_APP_ID is missing in .env.';
            }

            const renderSteps = (steps = []) => {
                const wrap = document.getElementById('es-steps');
                wrap.querySelector('tbody').innerHTML = steps.map((step) =>
                    `<tr><td>${escapeHtml(step.step)}</td><td>${escapeHtml(step.status)}</td><td>${step.error ? `<span class="badge bg-danger text-wrap">${escapeHtml(step.error)}</span>` : badge('OK')}</td></tr>`
                ).join('');
                wrap.hidden = steps.length === 0;
            };

            const renderStatus = (onboarding) => {
                const box = document.getElementById('es-status');
                const syncButtons = document.querySelectorAll('[data-sync]');
                if (!onboarding) {
                    box.innerHTML = '<p class="text-muted">No number connected yet.</p>';
                    syncButtons.forEach((button) => { button.disabled = true; });
                    return;
                }
                const phone = onboarding.phone || {};
                const synced = onboarding.synced || {};
                const onApp = phone.is_on_biz_app === true;
                box.innerHTML = `<div class="table-responsive"><table class="table table-bordered mb-3"><tbody>
                    <tr><th class="w-25">Phone number</th><td>${escapeHtml(phone.display_phone_number || '-')} · ${escapeHtml(phone.verified_name || '')}</td></tr>
                    <tr><th>Phone number ID</th><td>${escapeHtml(onboarding.phone_number_id)}</td></tr>
                    <tr><th>WABA ID</th><td>${escapeHtml(onboarding.waba_id)}</td></tr>
                    <tr><th>Platform</th><td>${escapeHtml(phone.platform_type || '-')} · on WhatsApp Business app: <span class="badge ${onApp ? 'bg-success' : 'bg-warning text-dark'}">${onApp ? 'yes' : 'no'}</span></td></tr>
                    <tr><th>Connected</th><td>${escapeHtml(onboarding.onboarded_at)} · sync before ${escapeHtml(onboarding.sync_deadline)}</td></tr>
                    <tr><th>Contacts sync</th><td>${escapeHtml(synced.smb_app_state_sync || 'not yet')}</td></tr>
                    <tr><th>History sync</th><td>${escapeHtml(synced.history || 'not yet')}</td></tr>
                </tbody></table></div>`;
                syncButtons.forEach((button) => { button.disabled = Boolean(synced[button.dataset.sync]); });
            };

            const loadStatus = async () => {
                const data = await call(routes.status);
                renderStatus(data.onboarding);
                const error = errorOf(data);
                if (error) show(syncResult, false, `Status: ${error}`);
            };

            const finishSignup = async (code) => {
                // The session event can arrive just after the login callback.
                await new Promise((resolve) => setTimeout(resolve, 1500));
                show(esResult, true, 'Signup finished. Connecting the number…');
                const data = await call(routes.exchange, { code, waba_id: session.waba_id, phone_number_id: session.phone_number_id });
                renderSteps(data.steps);
                const error = errorOf(data);
                if (error) {
                    show(esResult, false, `Error: ${error}`);
                    return;
                }
                show(esResult, true, 'Connected. Sync contacts and chat history within 24 hours.');
                renderStatus(data.onboarding);
            };

            launchButton.addEventListener('click', () => {
                session = {};
                esResult.hidden = true;
                FB.login((response) => {
                    const code = response?.authResponse?.code;
                    if (!code) {
                        show(esResult, false, `Signup closed before it finished${session.event ? ` (${session.event})` : ''}.`);
                        return;
                    }
                    finishSignup(code).catch((failure) => show(esResult, false, `Error: ${failure.message}`));
                }, {
                    config_id: es.configId,
                    response_type: 'code',
                    override_default_response_type: true,
                    extras: { setup: {}, featureType: 'whatsapp_business_app_onboarding', sessionInfoVersion: '3' },
                });
            });

            document.getElementById('es-refresh').addEventListener('click', () => loadStatus());

            document.querySelectorAll('[data-sync]').forEach((button) => {
                button.addEventListener('click', async () => {
                    const label = button.dataset.sync === 'history' ? 'chat history' : 'contacts';
                    const answer = await Swal.fire({
                        icon: 'question',
                        title: `Sync ${label} now?`,
                        text: 'This can be done only once. Is the webhook set up?',
                        showCancelButton: true,
                        confirmButtonText: 'Sync',
                    });
                    if (!answer.isConfirmed) return;
                    button.disabled = true;
                    const data = await call(routes.sync, { type: button.dataset.sync });
                    const error = errorOf(data);
                    if (error) {
                        show(syncResult, false, `Error: ${error}`);
                        button.disabled = false;
                        return;
                    }
                    show(syncResult, true, `Sync of ${label} requested (request ${data.request_id || '-'}). The data arrives at the webhook.`);
                    renderStatus(data.onboarding);
                });
            });

            const loadWebhookLog = async () => {
                const data = await call(routes.events);
                const box = document.getElementById('wh-log');
                box.textContent = data.entries?.length
                    ? data.entries.map((entry) => `[${entry.received_at}] ${entry.fields}\n${JSON.stringify(entry.payload, null, 2)}`).join('\n\n')
                    : 'No events yet.';
            };
            document.getElementById('wh-refresh').addEventListener('click', () => loadWebhookLog());

            document.getElementById('tab-connect').addEventListener('shown.bs.tab', () => {
                loadStatus();
                loadWebhookLog();
            });

            // /master/whatsapp#connect (or #assets, #manage, #send) opens that tab.
            document.getElementById(`tab-${location.hash.slice(1)}`)?.click();
        })();
    </script>
@endsection
