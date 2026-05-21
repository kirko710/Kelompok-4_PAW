<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AJAX Live Search</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100 p-8">

    <div class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Live Search User</h1>

        <input 
            type="text" 
            id="searchInput"
            placeholder="Cari nama atau email..."
            class="w-full border border-gray-300 rounded px-4 py-2 mb-4"
        >

        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border px-4 py-2">ID</th>
                    <th class="border px-4 py-2">Nama</th>
                    <th class="border px-4 py-2">Email</th>
                    <th class="border px-4 py-2">Role</th>
                </tr>
            </thead>
            <tbody id="resultBody">
                <tr>
                    <td colspan="4" class="text-center border px-4 py-2">
                        Ketik untuk mencari data...
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <script>
        const searchInput = document.getElementById('searchInput');
        const resultBody = document.getElementById('resultBody');

        let typingTimer;

        searchInput.addEventListener('input', function () {
            clearTimeout(typingTimer);

            typingTimer = setTimeout(() => {
                const keyword = searchInput.value;

                fetch(`/ajax/users/search?q=${encodeURIComponent(keyword)}`)
                    .then(response => response.json())
                    .then(result => {
                        resultBody.innerHTML = '';

                        if (result.data.length === 0) {
                            resultBody.innerHTML = `
                                <tr>
                                    <td colspan="4" class="text-center border px-4 py-2">
                                        Data tidak ditemukan
                                    </td>
                                </tr>
                            `;
                            return;
                        }

                        result.data.forEach(user => {
                            resultBody.innerHTML += `
                                <tr>
                                    <td class="border px-4 py-2">${user.id}</td>
                                    <td class="border px-4 py-2">${user.name}</td>
                                    <td class="border px-4 py-2">${user.email}</td>
                                    <td class="border px-4 py-2">${user.role}</td>
                                </tr>
                            `;
                        });
                    })
                    .catch(error => {
                        console.error('AJAX Error:', error);
                    });
            }, 300);
        });
    </script>

</body>
</html>