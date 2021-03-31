# Team Vimily TODO List

## Installation

### API `api/`

Copy `.env.example` to `.env`
```bash
cp api/.env.example api/.env
```

Run the docker-compose
```bash
docker-compose pull
docker-compose up -d
```

Generate APP Key
```bash
docker-compose exec vimily_php php artisan key:generate
```

Seed the database
```bash
docker-compose exec vimily_php php artisan db:seed
```

Test that your backend is set up correctly:
http://localhost:8000/api/todo

Debugging logs on api can be seen here:
http://localhost:8000/clockwork/app

### Frontend `frontend/`

Go to frontend directory
```bash
cd frontend
```

Install packages
```bash
yarn
```

Start the Server
```bash
yarn start
```

Test:

http://localhost:3000/

