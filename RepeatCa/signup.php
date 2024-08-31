<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="css/output.css" rel="stylesheet"> 
    <script src="https://unpkg.com/react@17/umd/react.development.js" crossorigin></script>
    <script src="https://unpkg.com/react-dom@17/umd/react-dom.development.js" crossorigin></script>
    <script src="https://unpkg.com/@babel/standalone@7/babel.min.js"></script>
</head>
<body>
    <?php include('header.php'); ?>
    
    <div id="signup-root"></div>

    <script type="text/babel">
        function Signup() {
          const [formData, setFormData] = React.useState({
            name: '',
            email: '',
            password: '',
            confirmPassword: '',
            termsAccepted: false,
          });

          const [errors, setErrors] = React.useState({});

          const handleChange = (e) => {
            const { name, value, type, checked } = e.target;
            setFormData({
              ...formData,
              [name]: type === 'checkbox' ? checked : value,
            });
          };

          const validateForm = () => {
            const newErrors = {};
            
            if (formData.password !== formData.confirmPassword) {
              newErrors.confirmPassword = "Passwords do not match";
            }

            if (!formData.termsAccepted) {
              newErrors.termsAccepted = "You must agree to the terms of service";
            }

            setErrors(newErrors);
            return Object.keys(newErrors).length === 0;
          };

          const handleSubmit = (e) => {
            e.preventDefault();

            if (validateForm()) {
              // Submit form data to PHP script
              fetch('/js/signupscript.php', {
                method: 'POST',
                headers: {
                  'Content-Type': 'application/json',
                },
                body: JSON.stringify(formData),
              })
              .then(response => response.json())
              .then(data => {
                if (data.success) {
                  alert(data.success);
                  // Redirect or clear the form
                } else if (data.error) {
                  alert(data.error);
                }
              })
              .catch((error) => {
                console.error('Error:', error);
              });
            }
          };

          return (
            <div className="min-h-screen flex items-center justify-center bg-gray-100">
              <div className="bg-white p-8 rounded-lg shadow-lg w-full max-w-md">
                <h2 className="text-2xl font-bold mb-6 text-center">Sign Up</h2>
                <form onSubmit={handleSubmit} className="space-y-4">
                  <div>
                    <label htmlFor="name" className="block text-sm font-medium text-gray-700">Name</label>
                    <input
                      type="text"
                      name="name"
                      id="name"
                      value={formData.name}
                      onChange={handleChange}
                      required
                      className="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </div>
                  <div>
                    <label htmlFor="email" className="block text-sm font-medium text-gray-700">Email</label>
                    <input
                      type="email"
                      name="email"
                      id="email"
                      value={formData.email}
                      onChange={handleChange}
                      required
                      className="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </div>
                  <div>
                    <label htmlFor="password" className="block text-sm font-medium text-gray-700">Password</label>
                    <input
                      type="password"
                      name="password"
                      id="password"
                      value={formData.password}
                      onChange={handleChange}
                      required
                      className="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                  </div>
                  <div>
                    <label htmlFor="confirmPassword" className="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input
                      type="password"
                      name="confirmPassword"
                      id="confirmPassword"
                      value={formData.confirmPassword}
                      onChange={handleChange}
                      required
                      className="mt-1 p-2 w-full border rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    {errors.confirmPassword && <p className="text-red-500 text-sm mt-1">{errors.confirmPassword}</p>}
                  </div>
                  <div className="flex items-center">
                    <input
                      type="checkbox"
                      name="termsAccepted"
                      id="termsAccepted"
                      checked={formData.termsAccepted}
                      onChange={handleChange}
                      className="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded"
                    />
                    <label htmlFor="termsAccepted" className="ml-2 block text-sm text-gray-900">I agree to the terms and conditions</label>
                  </div>
                  {errors.termsAccepted && <p className="text-red-500 text-sm mt-1">{errors.termsAccepted}</p>}
                  <button
                    type="submit"
                    className="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                  >
                    Sign Up
                  </button>
                </form>
              </div>
            </div>
          );
        }

        ReactDOM.render(<Signup />, document.getElementById('signup-root'));
    </script>
</body>
</html>
