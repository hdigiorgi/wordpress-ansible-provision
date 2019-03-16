mkfile_path := $(word $(words $(MAKEFILE_LIST)),$(MAKEFILE_LIST))
mkfile_dir:=$(shell cd $(shell dirname $(mkfile_path)); pwd)
PLAYBOOK := ANSIBLE_CONFIG=${mkfile_dir}/ansible.cfg ansible-playbook -i hosts.ini

.PHONY: help
help:
	@echo ""
	@echo "make facade: setups the selling point server"
	@echo ""

sales-server:
	${PLAYBOOK} -l sales-server tasks/sales-server.yml

wp:
	${PLAYBOOK} -l wp tasks/wp.yml
