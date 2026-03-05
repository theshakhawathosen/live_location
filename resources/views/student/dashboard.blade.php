@extends('layouts.student-layout')

@section('content')
    <main id="main-content">
        <div id="map-container">

            <div class="eta-bar map-overlay">
                <i class="fa-solid fa-location-dot eta-blink" style="color:var(--accent);font-size:14px;"></i>
                <span class="eta-label">Bus B (Route 04)</span>
                <span class="eta-val">ETA: 3 min</span>
                <span style="color:var(--border);">|</span>
                <span class="eta-label">Speed</span>
                <span class="eta-val">32 km/h</span>
            </div>

            <div class="map-overlay map-top-left">
                <div class="ov-card" style="padding:10px 14px;">
                    <div class="ov-title"><i class="fa-solid fa-route" style="margin-right:5px;"></i>Select Route
                    </div>
                    <select class="route-select" aria-label="Select bus route" onchange="changeRoute(this.value)">
                        <option value="04">Route 04 – Dhanmondi</option>
                        <option value="02">Route 02 – Mirpur</option>
                        <option value="06">Route 06 – Uttara</option>
                        <option value="08">Route 08 – Gazipur</option>
                        <option value="12">Route 12 – Narayanganj</option>
                    </select>
                </div>
            </div>

            <div class="map-overlay map-top-right">
                <button class="map-type-btn active" id="btn-road" onclick="setMapType('road')"> <i
                        class="fa-solid fa-map"></i> Road</button>
                <button class="map-type-btn" id="btn-sat" onclick="setMapType('sat')"> <i
                        class="fa-solid fa-satellite"></i> Satellite</button>
                <button class="map-type-btn" id="btn-transit" onclick="setMapType('transit')"><i
                        class="fa-solid fa-train-subway"></i> Transit</button>
            </div>

            <div class="map-overlay map-bottom-left">
                <div class="ov-card">
                    <div class="ov-title">Legend</div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:var(--accent);"></div>
                        <i class="fa-solid fa-bus-simple"
                            style="color:var(--accent);font-size:12px;width:14px;text-align:center;"></i>
                        Active Bus
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#f97316;"></div>
                        <i class="fa-solid fa-circle-dot"
                            style="color:#f97316;font-size:12px;width:14px;text-align:center;"></i>
                        Bus Stop
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#22c55e;"></div>
                        <i class="fa-solid fa-location-pin"
                            style="color:#22c55e;font-size:12px;width:14px;text-align:center;"></i>
                        Your Location
                    </div>
                    <div class="legend-item">
                        <div class="legend-dot" style="background:#a855f7;"></div>
                        <i class="fa-solid fa-route" style="color:#a855f7;font-size:12px;width:14px;text-align:center;"></i>
                        Route Path
                    </div>
                </div>
            </div>

            <!-- ── Google Map (replace YOUR_API_KEY & configure as needed) ── -->
            <!--
                  To enable the real map:
                  1. Get a Google Maps API key from https://console.cloud.google.com
                  2. Replace this placeholder with:

                  <div id="map"></div>
                  <script>
                      function initMap() {
                          const dhaka = {
                              lat: 23.7461,
                              lng: 90.3742
                          };
                          const map = new google.maps.Map(document.getElementById('map'), {
                              zoom: 14,
                              center: dhaka,
                              styles: darkStyles, // optional custom style array
                          });
                      }
                  </script>
                  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap" async defer></script>
                -->

            <!-- PLACEHOLDER MAP — shown until real API is connected -->
            <div id="map-placeholder">
                <iframe id="map" title="DIU Routes Live Map"
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d29215.35984870478!2d90.35420274999999!3d23.750933050000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka%2C%20Bangladesh!5e0!3m2!1sen!2sbd!4v1698000000000!5m2!1sen!2sbd"
                    width="100%" height="100%" style="border:none; display:block; min-height:calc(100vh - 62px - 44px);"
                    allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>

        </div><!-- /map-container -->
    </main>
@endsection
