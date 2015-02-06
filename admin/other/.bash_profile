# .bash_profile

# Get the aliases and functions
if [ -f ~/.bashrc ]; then
	. ~/.bashrc
fi

# User specific environment and startup programs

PATH=$PATH:$HOME/.local/bin:$HOME/bin

export PATH

CDTOPUBLIC="cd public_html/"
GITRESET="git reset HEAD --hard"
GITPULL="git pull origin master"

eval $CDTOPUBLIC
eval $GITRESET
eval $GITPULL
