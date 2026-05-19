function changeMonth(offset) {
            const params = new URLSearchParams(window.location.search);
            let daySelect = parseInt(params.get('daySelect')) || new Date().getDate();
            let month = parseInt(params.get('month')) || new Date().getMonth() + 1;
            let year = parseInt(params.get('year')) || new Date().getFullYear();

            month += offset;

            if (month > 12) { month = 1; year++; }
            if (month < 1) { month = 12; year--; }

            window.location.href = `?&daySelect=${daySelect}&month=${month}&year=${year}`;
        }

function changeDay(day) {
            const params = new URLSearchParams(window.location.search);
            let daySelect = day;
            let month = parseInt(params.get('month')) || new Date().getMonth() + 1;
            let year = parseInt(params.get('year')) || new Date().getFullYear();
            window.location.href = `?&daySelect=${daySelect}&month=${month}&year=${year}`;
        }