import re

with open("style.css", "r", encoding="utf-8") as f:
    lines = f.readlines()

print("Searching for hardcoded colors in style.css...")
for i, line in enumerate(lines):
    # Match lines containing 'color:' but not 'var('
    if "color:" in line and "var(" not in line:
        # Exclude comments
        if not line.strip().startswith("/*"):
            print(f"Line {i+1}: {line.strip()}")
