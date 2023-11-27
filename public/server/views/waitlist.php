<div class="bg-white p-8 rounded shadow-md animate__animated animate__zoomInDown">
    <h2 class="text-2xl font-bold mb-6 text-gray-900 text-center">Waitlist</h2>
    <div class="mt-10">
        <div>
            <?php
            // Define the inputs for the waitlist form
            $inputs = [
                [
                    'name' => 'username',
                    'label' => 'X Username',
                    'type' => 'text',
                    'placeholder' => '@username'
                ]
            ];
            // Call the function to generate the waitlist form
            inputForm($inputs, 'Continue');
            ?>
        </div>
    </div>
</div>