<style>
    .performance-badge {
        position: absolute;
        top: 14rem;
        left: 18rem;
        padding: 1rem;
        border-radius: 9999px;
        transform: rotate(12deg);
        border: 4px solid white;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        color: white;
        text-align: center;
    }

    .performance-badge.excellent { background-color: #22c55e; }
    .performance-badge.very-good { background-color: #3b82f6; }
    .performance-badge.good { background-color: #eab308; }

    .tab-content:not(.active) {
        display: none;
    }
</style>

 <!-- Lucide Icons -->
<div class="pt-[75px]">
    <div class="justify-center font-HellixR items-center flex" id='login-container'>
        <form name="login-branch" id="login-branch" method="post" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-sm">
            @csrf
            <h2 class="text-primary text-3xl font-HellixB text-center mb-4">Welcome, World</h2>
            <p class="text-center text-gray-700 mb-6">Please enter details for student information</p>
            
            <input type="text" id="registration_number" name="registration_number" placeholder="Registration No (C/0****)"
            class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" required />
            <input type="date" id="dob_input" name="dob_input" 
                class="w-full border border-gray-300 rounded-md p-3 mb-4 focus:outline-none focus:border-primary transition" required />
            <input type="button" value="Search Student"
                class="w-full bg-[#313131] text-white font-bold py-3 rounded-md hover:bg-[#000] transition cursor-pointer"
                onclick="searchSudent()" />
        </form>
    </div>
    <div class="hidden" id="student-details">
        <div class="max-w-7xl mx-auto p-6 bg-gray-50 min-h-[60vh]">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Left Column -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <img 
                            src="{{asset('assets/images/default_avatar.jpg')}}"
                            alt="Student Photo"
                            class="w-full h-64 object-cover rounded-lg mb-4"
                        />
                        
                        <div class="flex gap-4 mb-6" id="certificateStatus">
                            <div class="flex-1 bg-green-50 p-4 rounded-lg">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-green-500 mb-2"></i>
                                <p class="text-sm font-medium">Certificate Verified</p>
                            </div>
                            <div class="flex-1 bg-blue-50 p-4 rounded-lg">
                                <i data-lucide="check-circle-2" class="w-6 h-6 text-blue-500 mb-2"></i>
                                <p class="text-sm font-medium">Marksheet Verified</p>
                            </div>
                        </div>
    
                        <div class="bg-gradient-to-r from-orange-100 to-orange-200 p-4 rounded-lg">
                            <h3 class="text-orange-800 font-semibold mb-2">Aadhaar Number</h3>
                            <p class="font-mono text-xl tracking-wider text-orange-900" id="aadhaarNumber">
                                <!-- Will be populated by JavaScript -->
                            </p>
                        </div>
                    </div>
                </div>
    
                <!-- Right Column -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-lg shadow-lg">
                        <!-- Tabs -->
                        <div class="flex border-b">
                            <button data-tab="info" class="flex items-center px-6 py-4 border-b-2 border-blue-500 text-blue-600">
                                <i data-lucide="user-2" class="w-5 h-5 mr-2"></i>
                                Student Info
                            </button>
                            <button data-tab="academic" class="flex items-center px-6 py-4 text-gray-500">
                                <i data-lucide="graduation-cap" class="w-5 h-5 mr-2"></i>
                                Academic Details
                            </button>
                            <button data-tab="fees" class="flex items-center px-6 py-4 text-gray-500">
                                <i data-lucide="credit-card" class="w-5 h-5 mr-2"></i>
                                Fee Details
                            </button>
                        </div>
    
                        <!-- Tab Contents -->
                        <div class="p-6">
                            <!-- Student Info Tab -->
                            <div data-tab-content="info" class="tab-content active">
                                <div class="grid grid-cols-2 gap-6">
                                    <div>
                                        <h3 class="font-semibold mb-4">Personal Information</h3>
                                        <div class="space-y-3">
                                            <p><span class="text-gray-600">Name:</span> <span id="studentName"></span></p>
                                            <p><span class="text-gray-600">Registration No:</span> <span id="regNumber"></span></p>
                                            <p><span class="text-gray-600">Email:</span> <span id="email"></span></p>
                                            <p><span class="text-gray-600">Phone:</span> <span id="phone"></span></p>
                                            <p><span class="text-gray-600">Date of Birth:</span> <span id="dob"></span></p>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold mb-4">Family & Address</h3>
                                        <div class="space-y-3">
                                            <p><span class="text-gray-600">Father's Name:</span> <span id="fatherName"></span></p>
                                            <p><span class="text-gray-600">Mother's Name:</span> <span id="motherName"></span></p>
                                            <p><span class="text-gray-600">Address:</span> <span id="address"></span></p>
                                            <p><span class="text-gray-600">City:</span> <span id="city"></span></p>
                                            <p><span class="text-gray-600">State:</span> <span id="state"></span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Academic Details Tab -->
                            <div data-tab-content="academic" class="tab-content" id='marksTableId'>
                                <div class="overflow-x-auto">
                                    <table class="w-full" id="marksTable">
                                        <thead>
                                            <tr class="bg-gray-50">
                                                <th class="px-4 py-2 text-left">Subject</th>
                                                <th class="px-4 py-2 text-left">Marks</th>
                                                <th class="px-4 py-2 text-left">Percentage</th>
                                                <th class="px-4 py-2 text-left">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- Will be populated by JavaScript -->
                                        </tbody>
                                    </table>
                                </div>
    
                                <div class="mt-6 flex justify-between items-center">
                                    <div>
                                        <p class="text-lg font-semibold">Overall Percentage: <span id="overallPercentage"></span>%</p>
                                        <p class="text-md text-gray-600">Performance: <span id="performance"></span></p>
                                    </div>
                                    <div class="space-x-4 flex">
                                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg flex items-center">
                                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                            Download Certificate
                                        </button>
                                        <button class="bg-green-500 text-white px-4 py-2 rounded-lg flex items-center">
                                            <i data-lucide="download" class="w-4 h-4 mr-2"></i>
                                            Download Marksheet
                                        </button>
                                    </div>
                                </div>
                            </div>
    
                            <!-- Fee Details Tab -->
                            <div data-tab-content="fees" class="tab-content">
                                <div class="grid grid-cols-3 gap-6">
                                    <div class="bg-green-50 p-6 rounded-lg">
                                        <h3 class="text-lg font-semibold text-green-700">Total Fees</h3>
                                        <p class="text-2xl font-bold text-green-800">₹<span id="totalFees"></span></p>
                                    </div>
                                    <div class="bg-blue-50 p-6 rounded-lg">
                                        <h3 class="text-lg font-semibold text-blue-700">Paid Fees</h3>
                                        <p class="text-2xl font-bold text-blue-800">₹<span id="paidFees"></span></p>
                                    </div>
                                    <div class="bg-orange-50 p-6 rounded-lg">
                                        <h3 class="text-lg font-semibold text-orange-700">Due Fees</h3>
                                        <p class="text-2xl font-bold text-orange-800">₹<span id="dueFees"></span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Performance Badge -->
            {{-- <div id="performanceBadge" class="performance-badge">
                <i data-lucide="award" class="w-8 h-8 mb-1"></i>
                <span class="text-sm font-bold" id="performanceBadgeText"></span>
            </div> --}}
        </div>
    </div>
</div>
<script src="https://unpkg.com/lucide@latest"></script>

<script>
    const tabs = document.querySelectorAll('[data-tab]');
    const contents = document.querySelectorAll('[data-tab-content]');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
        // Remove active classes
        tabs.forEach(t => t.classList.remove('border-b-2', 'border-blue-500', 'text-blue-600'));
        contents.forEach(c => c.classList.remove('active'));
        
        // Add active classes
        tab.classList.add('border-b-2', 'border-blue-500', 'text-blue-600');
        const content = document.querySelector(`[data-tab-content="${tab.dataset.tab}"]`);
        content.classList.add('active');
        });
    });
</script>

<script>
    function searchSudent() {
        const registrationNumber = document.getElementById('registration_number').value;
        const dob = document.getElementById('dob_input').value;

        if (!registrationNumber || !dob) {
            toastr.error("Both Registration Number and Date of Birth are required.");
            return;
        }

        const newUrl = `/student_info?rn=${encodeURIComponent(registrationNumber)}&dob=${encodeURIComponent(dob)}`;
        window.location.href = newUrl;
    }
</script>

<script>
    const outputDiv = document.getElementById('student-details');
    const loginContainer = document.getElementById('login-container');

    document.addEventListener('DOMContentLoaded', async function () {
        const params = new URLSearchParams(window.location.search);
        const registrationNumber = params.get('rn');
        const dob = params.get('dob');

        if (registrationNumber && dob) {
            loginContainer.style.display = 'none';
            outputDiv.style.display = 'block';
            await fetchStudentDetails(registrationNumber, dob);
        }
    });

    function fetchStudentDetails(registrationNumber, dob) {
        const API_URL_WEB = "http://localhost:8000/api";
        const endpoint = `${API_URL_WEB}/admin/branch/get_student_details`;

        fetch(endpoint, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                registration_number: registrationNumber,
                dob: dob,
            }),
        })
            .then((response) => response.json())
            .then((result) => {
                if (result.error) {
                    toastr.error(result.message || "Failed to fetch student details.");
                } else {
                    displayStudentDetails(result.data);
                    // toastr.success("Student data retrieved successfully.");
                }
            })
            .catch((error) => {
                console.error(error);
                toastr.error("An error occurred while fetching student details.");
            });
    }

    function displayStudentDetails(data) {
        // Update basic info
        document.getElementById('studentName').textContent = data.student_name;
        document.getElementById('regNumber').textContent = data.registration_number;
        document.getElementById('email').textContent = data.student_email;
        document.getElementById('phone').textContent = data.student_phone;
        document.getElementById('dob').textContent = data.dob;
        document.getElementById('fatherName').textContent = data.student_father_name;
        document.getElementById('motherName').textContent = data.student_mother_name;
        document.getElementById('address').textContent = data.address;
        document.getElementById('city').textContent = data.city;
        document.getElementById('state').textContent = `${data.state} - ${data.zip}`;
        
        // Update Aadhaar
        document.getElementById('aadhaarNumber').textContent = data.aadhaar_number ? formatAadhaarNumber(data.aadhaar_number) : "Aadhaar Not found";
        
        // Update marks table
        if(data.marksheet_stage === 'verified') {
            document.getElementById('certificateStatus').style.display = 'flex';
            const marks = calculateMarks(data.marks);
            const tableBody = document.querySelector('#marksTable tbody');
            tableBody.innerHTML = marks.map(mark => `
                <tr class="border-t">
                    <td class="px-4 py-2">${mark.subject}</td>
                    <td class="px-4 py-2">${mark.marks}</td>
                    <td class="px-4 py-2">${mark.percentage}%</td>
                    <td class="px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-sm ${
                            mark.status === 'Pass' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'
                        }">
                            ${mark.status}
                        </span>
                    </td>
                </tr>
            `).join('');

            // Update performance and percentage
            document.getElementById('overallPercentage').textContent = data.overall_percent;
            document.getElementById('performance').textContent = data.performance;
        } else {
            document.getElementById('certificateStatus').style.display = 'none';
            document.getElementById('marksTableId').innerHTML = '<p class="text-center">Marksheet not verified yet.</p>';
        }
        
        
        // Update fees
        document.getElementById('totalFees').textContent = data.total_fees;
        document.getElementById('paidFees').textContent = data.paid_fees || '0.00';
        document.getElementById('dueFees').textContent = data.due_fees || data.total_fees;
        
        // Update performance badge
        // const badge = document.getElementById('performanceBadge');
        // badge.className = `performance-badge ${data.performance.toLowerCase().replace(' ', '-')}`;
        // document.getElementById('performanceBadgeText').textContent = data.performance;
        
        // Update student photo
        document.querySelector('img[alt="Student Photo"]').src = data.student_photo ?? "{{ asset('assets/images/default_avatar.jpg') }}";
    }

    function formatAadhaarNumber(number) {
        return number.replace(/(\d{4})/g, '$1 ').trim();
    }

    function calculateMarks(marksJson) {
        const marks = JSON.parse(marksJson);
        return Object.entries(marks).map(([subject, marks]) => ({
            subject,
            marks,
            percentage: marks,
            status: marks >= 40 ? 'Pass' : 'Fail'
        }));
    }
</script>

