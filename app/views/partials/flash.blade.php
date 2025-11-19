<div id="flash">
    @php
        $flashTypes = ['success', 'danger', 'warning', 'info', 'primary', 'secondary', 'light', 'dark'];
        $flashes = [];
        
        // Check if any flash messages exist
        foreach ($flashTypes as $type) {
            $flashData = request()->flash($type);
            if ($flashData) {
                $flashes[$type] = $flashData;
            }
        }
    @endphp

    @if(count($flashes) > 0)
        @foreach ($flashes as $type => $item)
            @php
                if (is_array($item)) {
                    $message = $item['message'] ?? $item['text'] ?? '';
                    $autoDismiss = $item['auto'] ?? false;
                    $duration = $item['duration'] ?? 5000;
                    $showProgress = $item['progress'] ?? true;
                    $pauseOnHover = $item['pauseOnHover'] ?? true;
                    $customClass = trim($item['class'] ?? '');
                    $dismissible = $item['dismissible'] ?? true;
                    
                    // Build alert classes
                    if ($customClass) {
                        $alertClasses = "alert {$customClass}";
                    } else {
                        $alertClasses = "alert alert-{$type}";
                    }
                    
                    if ($dismissible) {
                        $alertClasses .= ' alert-dismissible';
                    }
                    
                    $alertClasses .= ' fade show position-relative';
                } else {
                    $message = $item;
                    $autoDismiss = false;
                    $duration = 5000;
                    $showProgress = false;
                    $pauseOnHover = false;
                    $alertClasses = "alert alert-{$type} alert-dismissible fade show position-relative";
                    $dismissible = true;
                }
                
                $alertId = 'alert-' . uniqid();
            @endphp

            <div id="{{ $alertId }}" 
                  class="{{ $alertClasses }}" 
                  role="alert"
                  @if($autoDismiss) 
                    data-auto-dismiss="true" 
                    data-duration="{{ $duration }}"
                    data-show-progress="{{ $showProgress ? 'true' : 'false' }}"
                    data-pause-on-hover="{{ $pauseOnHover ? 'true' : 'false' }}"
                  @endif>
                
                {{ $message }}
                
                @if($dismissible)
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                @endif
                
                @if($autoDismiss && $showProgress)
                    <div class="alert-progress"></div>
                @endif
            </div>
        @endforeach

        @once
            @push('additional-scripts')
            <script @cspNonce>
            document.addEventListener('DOMContentLoaded', function() {
                const autoAlerts = document.querySelectorAll('[data-auto-dismiss="true"]');
                
                autoAlerts.forEach(function(alert) {
                    const duration = parseInt(alert.dataset.duration) || 5000;
                    const showProgress = alert.dataset.showProgress === 'true';
                    const pauseOnHover = alert.dataset.pauseOnHover === 'true';
                    
                    let timeoutId;
                    let remainingTime = duration;
                    let startTime = Date.now();
                    const progressBar = alert.querySelector('.alert-progress');
                    
                    if (showProgress && progressBar) {
                        progressBar.style.setProperty('--duration', duration + 'ms');
                        progressBar.classList.add('running');
                    }

                    // Start timer for auto dismiss
                    function startTimer() {
                        startTime = Date.now();
                        timeoutId = setTimeout(function() {
                            const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
                            bsAlert.close();
                        }, remainingTime);
                    }
                    
                    startTimer();

                    // Pause progress bar on hover
                    if (pauseOnHover) {
                        alert.addEventListener('mouseenter', function() {
                            clearTimeout(timeoutId);
                            remainingTime -= (Date.now() - startTime);
                            
                            if (progressBar) {
                                progressBar.classList.add('paused');
                            }
                        });
                        
                        alert.addEventListener('mouseleave', function() {
                            if (progressBar) {
                                progressBar.classList.remove('paused');
                                progressBar.style.setProperty('--duration', remainingTime + 'ms');
                            }
                            startTimer();
                        });
                    }

                    // Reset progress bar on close
                    alert.addEventListener('closed.bs.alert', function() {
                        clearTimeout(timeoutId);
                    });
                });
            });
            </script>
            @endpush
        @endonce
    @endif
</div>