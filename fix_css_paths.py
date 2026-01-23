
import os

base_dir = r"c:/xampp_ss/htdocs/GM-Legacy/about"
files_to_fix = [
    "founders-message.html",
    "principals-message.html",
    "philosophy-values.html",
    "nep-alignment.html",
    "school-history.html",
    "governance.html"
]

for filename in files_to_fix:
    path = os.path.join(base_dir, filename)
    if os.path.exists(path):
        with open(path, 'r', encoding='utf-8') as f:
            content = f.read()
        
        # Replace the incorrect CSS path
        # Look for href="css/style.css" which is incorrect for files in subdirectory
        new_content = content.replace('href="css/style.css"', 'href="../css/style.css"')
        
        if content != new_content:
            with open(path, 'w', encoding='utf-8') as f:
                f.write(new_content)
            print(f"Fixed CSS path in {filename}")
        else:
            print(f"No changes needed for {filename}")
    else:
        print(f"File not found: {filename}")
