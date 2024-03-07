document.addEventListener("DOMContentLoaded", function() {
    const canvas = document.getElementById('assinaturaCanvas');
    const context = canvas.getContext('2d');
    let isDrawing = false;
    let lastX = 0;
    let lastY = 0;

    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('touchstart', startDrawing);

    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('touchmove', draw);

    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('touchend', stopDrawing);

    canvas.addEventListener('mouseout', stopDrawing);
    canvas.addEventListener('touchcancel', stopDrawing);

    function startDrawing(e) {
        e.preventDefault();
        isDrawing = true;
        [lastX, lastY] = getPosition(e);
    }

    function draw(e) {
        e.preventDefault();
        if (!isDrawing) return;
        const [x, y] = getPosition(e);
        context.beginPath();
        context.moveTo(lastX, lastY);
        context.lineTo(x, y);
        context.strokeStyle = '#000';
        context.lineWidth = 2;
        context.stroke();
        [lastX, lastY] = [x, y];
    }

    function stopDrawing() {
        isDrawing = false;
        updateSignature();
    }

    function getPosition(e) {
        const rect = canvas.getBoundingClientRect();
        if (e.type === 'mousedown' || e.type === 'mouseup' || e.type === 'mousemove') {
            return [e.clientX - rect.left, e.clientY - rect.top];
        } else if (e.type === 'touchstart' || e.type === 'touchend' || e.type === 'touchmove') {
            return [e.touches[0].clientX - rect.left, e.touches[0].clientY - rect.top];
        }
    }

    function updateSignature() {
        const imageData = canvas.toDataURL(); // Convertendo a assinatura para base64
        document.getElementById('assinaturaInput').value = imageData; // Atualizando o valor do campo hidden
    }

    document.getElementById('limparAssinatura').addEventListener('click', () => {
        context.clearRect(0, 0, canvas.width, canvas.height);
        updateSignature();
    });
});
