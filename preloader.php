<div class="preloader">
    <div>
        <span class="adress-typed"><span>I</span>nWrite</span><span id="Ticker"></span>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var preloaderShown = localStorage.getItem('preloaderShown');
                if (!preloaderShown) {
                    var preloader = document.querySelector('div.preloader');
                    preloader.style.display = 'flex';
                    localStorage.setItem('preloaderShown', 'true');
                } else {
                    var preloader = document.querySelector('div.preloader');
                    preloader.style.display = 'none';
                }
            });


            var CharTimeout = 50;
            var StoryTimeout = 2500;
            var BlinkTimeout = 500;
            var InitialBlinkDuration = 1500;

            var Summaries = [];

            Summaries[0] = 'Share your thoughts in confidence. ';

            var isBlinkOn = true;
            var CurrentStory = -1;
            var CurrentLength = 0;
            var StorySummary = "";
            var AnchorObject;

            function startTicker() {
                massiveItemCount = Number(Summaries.length);
                AnchorObject = document.getElementById("Ticker");
                startBlinkingCursor();
                setTimeout(runTheTicker, InitialBlinkDuration);
            }

            function runTheTicker() {
                if (CurrentLength == 0) {
                    CurrentStory++;
                    if (CurrentStory >= massiveItemCount) {
                        document.querySelector('div.preloader').classList.add('preloader-none');
                        return;
                    }
                    StorySummary = Summaries[CurrentStory].replace(/"/g, '-');
                }

                AnchorObject.innerHTML = StorySummary.substring(0, CurrentLength) + `<span class="cursor">${isBlinkOn ? "|" : ""}</span>`;

                if (CurrentLength < StorySummary.length) {
                    CurrentLength++;
                    setTimeout(runTheTicker, CharTimeout);
                } else {
                    setTimeout(function() {
                        if (CurrentStory === massiveItemCount - 1) {
                            document.querySelector('div.preloader').classList.add('preloader-none');
                        }
                        CurrentLength = 0;
                        setTimeout(runTheTicker, InitialBlinkDuration);
                    }, StoryTimeout);
                }
            }

            function startBlinkingCursor() {
                setInterval(function() {
                    isBlinkOn = !isBlinkOn;
                    if (CurrentLength >= StorySummary.length) {
                        AnchorObject.innerHTML = StorySummary + `<span class="cursor">${isBlinkOn ? "|" : ""}</span>`;
                    } else {
                        AnchorObject.innerHTML = StorySummary.substring(0, CurrentLength) + `<span class="cursor">${isBlinkOn ? "|" : ""}</span>`;
                    }
                }, BlinkTimeout);
            }

            startTicker();
        </script>
    </div>
</div>