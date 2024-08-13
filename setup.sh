#!/bin/bash

# Function to prompt for database name
function prompt_database_name {
    read -p "Enter the database name: " db_name
}

# Function to create a new Laravel project
function create_laravel_project {
    read -p "Enter the project name: " project_name
    laravel new $project_name
    cd $project_name || exit
}

# Function to switch to develop branch
function switch_to_develop_branch {
    git checkout -b develop
}

# Function to update .env file
function update_env_file {
    sed -i "s/DB_CONNECTION=sqlite/DB_CONNECTION=mysql/" .env
    sed -i "s/DB_DATABASE=.*/DB_DATABASE=$db_name/" .env
    sed -i "s/DB_USERNAME=.*/DB_USERNAME=root/" .env
    sed -i "s/DB_PASSWORD=.*/DB_PASSWORD=root/" .env
    echo -e "APP_LOCALE=it\nAPP_FALLBACK_LOCALE=it\nAPP_FAKER_LOCALE=it_IT" >> .env
}

# Function to install Composer packages and publish config files
function install_packages {
    while IFS= read -r package; do
        repo=$(jq -r --arg name "$package" '.packages[] | select(.name==$name) | .repository' dependencies.json)
        version=$(jq -r --arg name "$package" '.packages[] | select(.name==$name) | .version // ""' dependencies.json)
        
        if [ -z "$version" ]; then
            composer require "$repo"
        else
            composer require "$repo:$version"
        fi

        # Publish configuration files
        php artisan vendor:publish --tag=config
        
        # Check if there are post-install commands
        commands=$(jq -r --arg name "$package" '.packages[] | select(.name==$name) | .post_install[]?' dependencies.json)
        if [ -n "$commands" ]; then
            echo "Executing post-install commands for $package"
            for cmd in $commands; do
                eval "$cmd"
            done
        fi
    done <<< "$(jq -r '.packages[].name' dependencies.json | fzf --multi)"
}

# Function to install npm dependencies
function install_npm_dependencies {
    npm install flatpickr
}

# Function to copy preset files
function copy_preset_files {
    cp -r /path/to/preset/files/* .
}

# Function to update routes
function update_routes {
    cat <<EOT > routes/auth.php
<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Livewire\Auth\ForgotPassword;
use App\Livewire\Auth\Login;
use App\Livewire\Auth\ResetPassword;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)->name('login');
    Route::get('forgot-password', ForgotPassword::class)->name('password.request');
    Route::get('reset-password/{token}', ResetPassword::class)->name('password.reset');
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
EOT
}

# Main script execution
prompt_database_name
create_laravel_project
switch_to_develop_branch
update_env_file
install_packages
install_npm_dependencies
copy_preset_files
update_routes

echo "Setup complete!"
