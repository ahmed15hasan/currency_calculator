# Laravel Currency Update and Calculator

This repository contains a Laravel application for updating currency rates and performing currency calculations. It uses Docker for containerization and scheduling commands for regular updates.

## Getting Started

### Prerequisites

- Docker
- Docker Compose

### Setup

1. **Build and Start Docker Containers**

   Build and start the Docker containers in detached mode using:

    ```sh
   docker-compose up -d --build

2. **Run Migrations**  

    ```sh
    docker-compose exec web php artisan migrate

3. **Run Currency Update Command**

    To manually trigger the currency update process, execute the following command inside the web container:

    ```sh
    docker-compose exec web php artisan currency:update-rates

4. **Access the Application**

    After setting up and running the Docker containers, you can access the application by navigating to:

    http://localhost:8000/currency-calculator

    This URL will redirect you to the currency calculator interface of the application.

### Project Structure

    Dockerfile: Defines the Docker image for the Laravel application.

    docker-compose.yml: Contains the configuration for Docker services, including the web server and database.

    app/Console/Commands/UpdateCurrencyRates.php: Laravel console command for updating currency rates. 
     

### Environment Variables

    APP_URL=http://localhost:8000/
    CURRENCY_EXCHANGE_API_KEY=your_api_key_here 
    CURRENCY_EXCHANGE_API_URL=https://api.example.com
    

### Cron Job Setup

To automate the currency rate updates, configure a cron job to run Laravel's scheduler every minute. Add the following  line to your server's crontab: 
    
 
    * * * * * cd /path-to-your-project && php artisan schedule:run >> /dev/null 2>&1  
    
    
### Notes

1. **Make sure to replace `your_api_key_here` and `https://api.example.com` with your actual API key and API URL.**
2. **Update the `/path-to-your-project` with the actual path to your project in the cron job setup section.**

This README file provides clear instructions for setting up and running the application, along with useful troubleshooting tips and project structure information.
   








