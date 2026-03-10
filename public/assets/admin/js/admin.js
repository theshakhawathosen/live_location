
        // Sidebar toggle
        function toggleSidebar() {
            const sb = document.getElementById("sidebar");
            const ov = document.getElementById("sb-overlay");
            sb.classList.toggle("open");
            ov.classList.toggle("show");
            ov.classList.toggle("hidden");
        }

        function closeSidebar() {
            document.getElementById("sidebar").classList.remove("open");
            const ov = document.getElementById("sb-overlay");
            ov.classList.remove("show");
            ov.classList.add("hidden");
        }

        // Submenu toggle
        function toggleSub(id, btn) {
            const sub = document.getElementById(id);
            const ch = btn.querySelector(".chevron");
            sub.classList.toggle("open");
            ch && ch.classList.toggle("rotate-180");
        }

        // Dropdown toggle
        function toggleDd(id) {
            document.querySelectorAll(".dd").forEach((d) => {
                if (d.id !== id) d.classList.remove("open");
            });
            document.getElementById(id).classList.toggle("open");
        }
        document.addEventListener("click", (e) => {
            if (
                !e.target.closest('[onclick*="toggleDd"]') &&
                !e.target.closest(".dd")
            )
                document
                .querySelectorAll(".dd")
                .forEach((d) => d.classList.remove("open"));
        });

        function showToast() {
            var t = document.getElementById("toast");
            t.classList.add("show");
            setTimeout(function() {
                t.classList.remove("show");
            }, 3000);
            let audio = new Audio("{{ asset('assets/audio/success.wav') }}");
            audio.play().catch(error => {
                console.log('Faild to play success audio!');
            });
        }

        // Charts — read accent color from CSS var at runtime
        const accentHex = getComputedStyle(document.documentElement).getPropertyValue('--accent').trim();
        const txtC = getComputedStyle(document.documentElement).getPropertyValue('--txt-m').trim();
        const gridC = "rgba(255,255,255,0.05)";

        new Chart(document.getElementById("growthChart"), {
            type: "line",
            data: {
                labels: ["Oct", "Nov", "Dec", "Jan", "Feb", "Mar"],
                datasets: [{
                        label: "Students",
                        data: [820, 920, 1020, 1100, 1210, 1284],
                        borderColor: accentHex,
                        backgroundColor: "rgba(14,165,168,0.08)",
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: accentHex,
                    },
                    {
                        label: "Drivers",
                        data: [38, 40, 42, 44, 46, 48],
                        borderColor: "#f97316",
                        backgroundColor: "rgba(249,115,22,0.07)",
                        fill: true,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: "#f97316",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 11
                            },
                            boxWidth: 10,
                            padding: 12,
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            },
                            maxRotation: 0,
                        },
                        grid: {
                            color: gridC
                        },
                    },
                    y: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            }
                        },
                        grid: {
                            color: gridC
                        },
                    },
                },
            },
        });

        new Chart(document.getElementById("tripsChart"), {
            type: "bar",
            data: {
                labels: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                datasets: [{
                    label: "Trips",
                    data: [42, 58, 51, 67, 72, 38, 20],
                    backgroundColor: accentHex + "cc",
                    borderRadius: 6,
                    borderSkipped: false,
                }, ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        labels: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 11
                            },
                            boxWidth: 10,
                        },
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            },
                            maxRotation: 0,
                        },
                        grid: {
                            color: gridC
                        },
                    },
                    y: {
                        ticks: {
                            color: txtC,
                            font: {
                                family: "Nunito",
                                size: 10
                            }
                        },
                        grid: {
                            color: gridC
                        },
                    },
                },
            },
        });

