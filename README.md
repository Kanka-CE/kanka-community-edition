# Kanka Community Edition
*A community-maintained, self-hostable variant of the Kanka worldbuilding platform.*
If you want to self-host Kanke-CE take a look at the [kanka-ce-container](https://github.com/kinnewig/kanka-ce-container).


## What is this?

**Kanka Community Edition (Kanka CE)** is a community-maintained fork of the official  
[Kanka](https://github.com/owlchester/kanka) worldbuilding platform.
It contains the **a slighly modified source code** of Kanka to make selfhosting easier 
and is used as base to build the [kanka-ce-container](https://github.com/kinnewig/kanka-ce-container).
To maintain compatibility with the original upstream Kanka codebase most changes are
handled as patches, which can be found in [kanka-ce-container](https://github.com/kinnewig/kanka-ce-container).

Kanka CE is **not** affiliated with the official Kanka project.


## Quick Start Guide (Docker)

Kanka-CE comes as ready to (Docker-)container.
You can find the self-hosting instructions also in the [Wiki](https://github.com/kinnewig/kanka-community-edition/wiki/Self%E2%80%90Hosting-Guide).

### Preparation
 This guide assumes your server is already up and running, with a recent and updated version of a server‑suitable Linux distribution, e.g., [Rocky Linux](https://rockylinux.org/), [Debian](https://www.debian.org/index.de.html), etc. 
You also need to install either [Docker](https://docs.docker.com/engine/install/) and docker-compose or, if you are using [Podman](https://podman.io/docs/installation), respectively Podman and podman-compose.

<details>
<summary>Docker – Debian (apt)</summary>

```bash
sudo apt -y install docker docker-compose
```

</details>

<details>
<summary>Podman – Debian (apt)</summary>

```bash
sudo apt -y install podman podman-compose
```

</details>

<details>
<summary>Docker – Rocky Linux (dnf)</summary>

For more details, see [the official documentation](https://docs.rockylinux.org/10/gemstones/containers/docker/).

Add the Docker repository:

```bash
sudo dnf config-manager --add-repo https://download.docker.com/linux/rhel/docker-ce.repo
```

Install Docker, Docker Compose, and other useful plugins:

```bash
sudo dnf -y install docker-ce docker-ce-cli containerd.io docker-buildx-plugin docker-compose-plugin
```

Start and enable Docker:

```bash
sudo systemctl --now enable docker
```

</details>

<details>
<summary>Podman – Rocky Linux (dnf)</summary>

Enable EPEL repositories:

```bash
sudo dnf config-manager --set-enabled crb
sudo dnf install epel-release
```

Install Podman and Podman Compose:

```bash
sudo dnf -y install podman podman-compose
```

</details>

### Running Kanka-CE
- Download the `docker-compose`, `.env.example`, and `gen-passwords.sh`, this can be simply done via:
```bash
git clone git@github.com:kinnewig/kanka-ce-container.git
```

- Enter the new folder and create a `.env` file by copying and adjusting `env.example`:
```bash
cp env.example .env
```

- Set strong passwords in the security section options of .env file by running the following bash script
```bash
./gen-passwords.sh
```

- Create the persistent folder
```bash
source .env
mkdir -p ${KANKA_CE_DATA}/{kanka,mariadb,meilisearch}

# Adjust the permissions (replace the User-ID with the user ID used by Docker, e.g., 999, ...)
chown -R 1000:1000 ${KANKA_CE_DATA}
```

- Run Kanka-CE
```bash
docker compose up -d
```

### Post installation
You can access the web UI at http://localhost:80 (or a different port, in case you edited the .env file).
It is strongly recommended to set up a reverse proxy.
You can take this nginx configuration as a starting point. Just replace `{your-domain}.com` with your actual domain, and `{ip-of-your-kanka-ce-host}` with the local IP of the machine running Kanka CE.

<details>
<summary>Example nginx configuration</summary>

```nginx
server {
    listen 80;
    server_name kanka.{your-domain}.com;

    # Redirect all HTTP requests to HTTPS
    return 301 https://$host$request_uri;
}

server {
    listen 443 ssl;
    server_name kanka.{your-domain}.com;

    # To only allow local traffic, uncomment the following two lines:
    #allow  192.168.1.0/24;
    #deny   all;

    # Restrict the maximal upload size, 0 means no restriction.
    client_max_body_size 0;

    add_header Strict-Transport-Security "max-age=15552000; includeSubDomains; preload;" always;

    # SSL configuration
    ssl_certificate /etc/letsencrypt/live/{your-domain}.com/fullchain.pem;
    ssl_certificate_key /etc/letsencrypt/live/{your-domain}.com/privkey.pem;

    # Reverse proxy to Kanka CE
    location / {
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
        proxy_pass http://{ip-of-your-kanka-ce-host}:8081;
        proxy_redirect off;
    }
}
```

</details>

- Note: Enable Premium for your world!
  Premium is not enabled by default (yet), so you need to enable the premium features for your world by hand.


## Development Guide

For a detailed instruction how to run the the development build see the [Wiki page](https://github.com/kinnewig/kanka-community-edition/wiki/Development).

## Contributing

Kanka Community Edition can only exist if the community helps build it.
To get started, you can read the [contributing guide](https://github.com/kinnewig/kanka-community-edition/blob/nightly/CONTRIBUTING.md)
or take a look at the [ToDo List](https://github.com/kinnewig/kanka-community-edition/nightly/develop-ce/TODO.md).

This project is entirely maintained by volunteers, people who love Kanka, want to self‑host it, and believe in open collaboration. Every improvement, every fix, every idea comes from people like you. Kanka CE is still in an early stage, so help is apprichiated very much!

No contribution is too small, even a typo fix helps move the project forward.

If you want Kanka CE to grow, stay compatible, and remain self‑hostable,  
**please consider contributing. The Community Edition lives through its community.**


## ❤️ Support the Official Kanka Project
Kanka CE exists because the upstream project is amazing.
If you enjoy using Kanka or Kanka CE, please consider supporting the original creators:

💙 **Kanka Website:** https://kanka.io  

## License

This repository contains a modified version of the official Kanka source code, which is licensed under *Commons Clause License Condition v1.0*

- You may not remove or alter the Commons Clause.
- You may not sell this software or offer it as a paid service.
- See the included LICENSE file for full details.


## Notice
This repository contains modifications made by the community.
All original work is © the Kanka authors.


