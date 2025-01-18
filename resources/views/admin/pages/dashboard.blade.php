<div>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md px-6 py-2 mb-5">
        <h1 class="text-[1rem] font-HellixB text-center">This website is under developement if any issue contact admins</h1>
    </div>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <div class="flex items-center justify-between border-b pb-4 mb-4">
          <h1 class="text-2xl font-HellixB"">Branch Dashboard</h1>
        </div>
    
        <div class="flex items-center space-x-4">
          <img id="branchImage" src="" alt="Branch Image" class="w-24 h-24 rounded-full object-cover">
          <div>
            <h2 id="branchName" class="text-xl font-HellixB"></h2>
            <p id="branchRole" class="text-gray-600"></p>
          </div>
        </div>
    
        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div class="bg-gray-100 p-4 rounded shadow">
            <h3 class="text-lg font-HellixB">Branch Details</h3>
            <p><strong>Email:</strong> <span id="branchEmail"></span></p>
            <p><strong>Address:</strong> <span id="branchAddress"></span></p>
            <p><strong>City:</strong> <span id="branchCity"></span></p>
            <p><strong>State:</strong> <span id="branchState"></span></p>
            <p><strong>ZIP:</strong> <span id="branchZip"></span></p>
          </div>
          <div class="flex flex-col gap-4">
            <div class="bg-gray-100 p-4 rounded shadow">
                <h3 class="text-sm font-HellixB">Countdown to Logout</h3>
                <p id="countdown" class="text-2xl font-bold text-red-500"></p>
            </div>
            <div class="bg-gray-100 p-4 rounded shadow">
                <h3 class="text-sm font-HellixB">Credit Remaining</h3>
                <p id="credit" class="text-2xl font-bold text-red-500">
                    <div id='spinner'>
                        @include('admin.components.spinner', ["class" => 'mt-2'])
                    </div>
                </p>
            </div>
          </div>
        </div>
    </div>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mt-5 flex justify-center items-center gap-3">
        <a class="block px-4 py-2 rounded-lg transition-colors font-HellixB bg-black text-white" href="#">Add Student</a>
        <a class="block px-4 py-2 rounded-lg transition-colors font-HellixB bg-black text-white" href="#">Add Student</a>
        <a class="block px-4 py-2 rounded-lg transition-colors font-HellixB bg-black text-white" href="#">Add Student</a>
    </div>
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6 mt-5">
        <div class="flex items-center justify-between border-b pb-4 mb-4">
          <h1 class="text-xl font-HellixB">Branch Students Details</h1>
        </div>
    </div>
</div>

<script>
    const branchData = JSON.parse(sessionStorage.getItem('branchData'));
    const spinner = document.getElementById('spinner');
    const credit = document.getElementById('credit');
    const API_URL_WEB = `https://abcedupro.com/api`;
    if (branchData) {
      const { branchData: data, expiryTime } = branchData;

      document.getElementById('branchImage').src = data.image;
      document.getElementById('branchName').textContent = data.branchName + ' (' + data.branchCode + ')';
      document.getElementById('branchRole').textContent = data.role.charAt(0).toUpperCase() + data.role.slice(1);
      document.getElementById('branchEmail').textContent = data.email;
      document.getElementById('branchAddress').textContent = `${data.addressLine1}, ${data.addressLine2}`;
      document.getElementById('branchCity').textContent = data.city;
      document.getElementById('branchState').textContent = data.state;
      document.getElementById('branchZip').textContent = data.zip;

      const countdownElement = document.getElementById('countdown');
      const interval = setInterval(() => {
        const now = new Date().getTime();
        const distance = expiryTime - now;

        if (distance <= 0) {
          clearInterval(interval);
          alert('Session expired! Logging out.');
          sessionStorage.clear();
          window.location.href = '/admin/login';
        } else {
          const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
          countdownElement.textContent = `${minutes}m ${seconds}s remaining`;
        }
      }, 1000);

      fetchCredtOfBranch(data.branch_id);

    }

    function fetchCredtOfBranch(branchId) {
        const endpoint = `${API_URL_WEB}/admin/branch/get_credit`;

        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({branch_id: branchId})
        })
            .then((response) => response.json())
            .then((result) => {
                if (result.error) {
                    toastr.error(result.message || "Failed To Fetch Credit");
                } else {
                    spinner.style.display = 'none';
                    credit.textContent = result.data.credit;
                }
            })
            .catch((error) => {
                console.error(error);
                toastr.error("Failed To Fetch Credit");
            });
    }
  </script>