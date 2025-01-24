<style>
    .text-with-line,
    .text-with-line2,
    .text-with-line3 {
        position: relative;
        display: inline-block;
    }

    .text-with-line::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 100px;
        /* Adjust this value for distance from text */
        height: 4px;
        width: 20px;
        /* Adjust this value for length of the line */
        background-color: red;
        transform: translateY(-50%);
    }

    .text-with-line2::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 60px;
        /* Adjust this value for distance from text */
        height: 4px;
        width: 20px;
        /* Adjust this value for length of the line */
        background-color: green;
        transform: translateY(-50%);
    }

    .text-with-line3::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 60px;
        /* Adjust this value for distance from text */
        height: 4px;
        width: 20px;
        /* Adjust this value for length of the line */
        background-color: blue;
        transform: translateY(-50%);
    }


    /* General Styling for Step */
    .step {
        padding: 20px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background-color: #f9f9f9;
        margin-bottom: 20px;
    }

    /* Heading */
    .step-heading {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Terms Content */
    .terms-content {
        font-size: 1rem;
        line-height: 1.6;
        color: #333;
    }

    .terms-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .terms-description {
        margin-bottom: 20px;
        font-style: italic;
        color: #555;
    }

    /* Terms Steps */
    .terms-steps {
        list-style-type: decimal;
        margin-left: 20px;
        margin-bottom: 20px;
    }

    .terms-steps li {
        margin-bottom: 10px;
    }

    .terms-steps strong {
        display: block;
        margin-bottom: 5px;
        font-weight: bold;
    }

    /* Nested Lists */
    .terms-steps ul {
        list-style-type: disc;
        margin-left: 20px;
    }

    .terms-steps ul li {
        margin-bottom: 5px;
    }

    /* Example Section */
    .terms-example {
        background-color: #e9ecef;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
        margin-bottom: 20px;
        font-family: "Courier New", Courier, monospace;
        font-size: 1rem;
        line-height: 1.5;
    }

    .terms-example span {
        font-weight: bold;
    }

    /* Form Check */
    .form-check-label {
        font-size: 1rem;
        color: #333;
    }

    /* Finish Button */
    #finishProcess {
        padding: 10px 20px;
        font-size: 1rem;
        font-weight: bold;
    }

    /* Ensure the modal body is scrollable */
    .modal-body {
        max-height: calc(100vh - 200px);
        /* Subtract header/footer height */
        overflow-y: auto;
        /* Enable vertical scrolling */
        padding: 15px;
    }

    /* Ensure the modal is responsive */
    .modal-dialog {
        max-width: 900px;
        /* Adjust for larger modals if needed */
        margin: 1.75rem auto;
    }

    .marquee-container {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
        padding: 10px;
        overflow: hidden;
        position: relative;
        width: 100%;
    }

    .marquee {
        display: inline-block;
        white-space: nowrap;
        animation: marquee 10s linear infinite;
    }

    @keyframes marquee {
        from {
            transform: translateX(100%);
        }

        to {
            transform: translateX(-100%);
        }
    }
    .modal{
        margin-top: -100px;
    }
</style>